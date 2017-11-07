<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use SmoDav\Models\Order;
use SmoDav\Models\OrderLine;
use SmoDav\Models\Stall;
use SmoDav\Models\Stock;
use SmoDav\Models\StockItem;
use SmoDav\Models\Supplier;
use SmoDav\Models\UnitConversion;
use SmoDav\Models\UnitOfMeasure;

class GoodsReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['lines'] = json_decode($data['lines']);
        $data['account_id'] = $request->get('supplier_id');
        $data['user_id'] = Auth::id();
        $data['document_type'] = Order::GOODS_RECEIVED_VOUCHER;
        $data['document_status'] = Order::STATUS_ARCHIVED;
        $data['total_exclusive'] = 0;
        $data['total_inclusive'] = 0;
        $data['total_tax'] = 0;
        if (! $data['due_date']) {
            $data['due_date'] = Carbon::parse($request->get('order_date'));
        }

        $data['lines'] = array_filter($data['lines'], function ($item) {
            return floatval($item->quantity) > 0;
        });

        if (! count($data['lines'])) {
            flash('Please receive at least one item');

            return redirect()->back();
        }

        foreach ($data['lines'] as $line) {
            $data['total_exclusive'] += $line->totalExcl;
            $data['total_inclusive'] += $line->totalIncl;
            $data['total_tax'] += $line->totalTax;
        }



        DB::transaction(function () use ($data) {
            $order = Order::create($data);
            $sampleLineId = null;

            // TODO: Implement cache

            $conversions = UnitConversion::all();

            foreach ($data['lines'] as $line) {
                $line->quantity = $this->updateQuantity($line, $conversions);
                OrderLine::where('id', $line->id)->increment('processed_quantity', $line->quantity);
                Stock::where('stall_id', $data['stall_id'])
                    ->where('item_id', $line->itemId)
                    ->increment('quantity_on_hand', $line->quantity);
                $sampleLineId = $line->id;
            }

            $data['lines'] = array_map(
                function ($line) use ($order, $data) {
                    $line = (array) $line;
                    $line['order_id'] = $order->id;
                    $line['stall_id'] = $data['stall_id'];
                    $line['stock_item_id'] = $line['itemId'];
                    $line['uom'] = $line['conversionId'];
                    $line['order_quantity'] = $line['quantity'];
                    $line['processed_quantity'] = $line['quantity'];
                    $line['discount'] = 0;
                    $line['tax_id'] = $line['taxId'];
                    $line['tax_rate'] = $line['taxRate'];
                    $line['unit_exclusive'] = $line['unitExclPrice'];
                    $line['unit_inclusive'] = $line['unitInclPrice'];
                    $line['unit_tax'] = $line['unit_inclusive'] - $line['unit_exclusive'];
                    $line['total_exclusive'] = $line['order_quantity'] * $line['unit_exclusive'];
                    $line['total_inclusive'] = $line['order_quantity'] * $line['unit_inclusive'];

                    unset(
                        $line['itemId'], $line['conversionId'], $line['quantity'], $line['taxId'], $line['taxRate'],
                        $line['unitExclPrice'], $line['unitInclPrice'], $line['totalExcl'], $line['totalIncl'],
                        $line['totalTax'], $line['id']
                    );

                    return $line;
                },
                $data['lines']
            );

            OrderLine::insert($data['lines']);

            $sampleOrder = OrderLine::find($sampleLineId);

            $exists = OrderLine::where('order_id', $sampleOrder->order_id)
                ->whereColumn('processed_quantity', '<', 'order_quantity')
                ->exists();

            if (! $exists) {
                Order::where('id', $sampleOrder->order_id)->update([
                    'document_status' => Order::STATUS_ARCHIVED
                ]);

                return;
            }

            Order::where('id', $sampleOrder->order_id)->update([
                'document_status' => Order::STATUS_PARTIALLY_PROCESSED
            ]);
        });



        flash('Successfully received goods');

        return redirect()->route('purchaseOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function receive($id)
    {
        if (request()->ajax()) {
            $items = StockItem::with(['conversions', 'buyingTax' => function ($builder) {
                return $builder->select(['id', 'rate']);
            }])
                ->get(['name', 'id', 'code', 'stocking_uom', 'buying_tax']);

            $order = Order::with(['lines' => function ($builder) {
                return $builder->whereRaw('processed_quantity < order_quantity');
            }])->findOrFail($id);


            return Response::json([
                'order' => $order,
                'items' => $items,
                'uoms' => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
                'suppliers' => Supplier::active()->get(['id', 'name', 'account_number']),
                'stalls' => Stall::all(),
                'status' => Order::STATUS_PARTIALLY_PROCESSED
            ]);
        }

        return view('goods-received.receive')->with('id', $id);
    }

    private function updateQuantity($line, $conversions)
    {
        $conversion = $conversions
            ->where('stock_item_id', $line->itemId)
            ->where('converted_unit_id', $line->conversionId)
            ->first();

        if (! $conversion) {
            return $line->quantity;
        }

        if ($conversion->converted_ratio < $conversion->stocking_ratio) {
            return $line->quantity * ($conversion->stocking_ratio / $conversion->converted_ratio);
        }

        return $line->quantity / ($conversion->converted_ratio / $conversion->stocking_ratio);
    }

}
