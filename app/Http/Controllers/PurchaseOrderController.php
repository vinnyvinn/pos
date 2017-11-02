<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use SmoDav\Models\Order;

use SmoDav\Models\OrderLine;
use SmoDav\Models\Stall;
use SmoDav\Models\StockItem;
use SmoDav\Models\Supplier;
use SmoDav\Models\UnitOfMeasure;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        switch (request('t')) {
            case 'unprocessed':
                $orders = Order::purchase()->unprocessed()->with(['supplier', 'stall'])->get();
                $title = 'Unprocessed';
                break;
            case 'partial':
                $orders = Order::purchase()->partial()->with(['supplier', 'stall'])->get();
                $title = 'Partially Processed';
                break;
            case 'archived':
                $orders = Order::purchase()->archived()->with(['supplier', 'stall'])->get();
                $title = 'Archived';
                break;
            case 'received':
                $orders = Order::received()->with(['supplier', 'stall'])->get();
                $title = 'Received';
                break;
            default:
                $orders = Order::purchase()->with(['supplier', 'stall'])->get();
                $title = 'All';
                break;
        }


        return view('purchase-order.index')
            ->with('orders', $orders)
            ->with('title', $title);
    }


    public function create()
    {
        if (request()->ajax()) {
            $items = StockItem::with(
                ['conversions', 'buyingTax' => function ($builder) {
                    return $builder->select(['id', 'rate']);
                }])
                ->get(['name', 'id', 'code', 'stocking_uom', 'buying_tax']);

            return Response::json(
                [
                    'items'     => $items,
                    'uoms'      => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
                    'suppliers' => Supplier::active()->get(['id', 'name', 'account_number']),
                    'stalls'    => Stall::all()
                ]);
        }

        return view('purchase-order.create');
    }

  
    public function store(Request $request)
    {
        $data = $request->all();
        $data['lines'] = json_decode($data['lines']);
        $data['account_id'] = $request->get('supplier_id');
        $data['user_id'] = Auth::id();
        $data['document_type'] = Order::PURCHASE_ORDER;
        $data['document_status'] = Order::STATUS_UNPROCESSED;

        if ($data['due_date'] == null) {
        $data['total_exclusive'] = 0;
        $data['total_inclusive'] = 0;
        $data['total_tax'] = 0;
        if (! $data['due_date']) {
            $data['due_date'] = Carbon::parse($request->get('order_date'));
        }

        foreach ($data['lines'] as $line) {
            $data['total_exclusive'] += $line->totalExcl;
            $data['total_inclusive'] += $line->totalIncl;
            $data['total_tax'] += $line->totalTax;
        }

        \DB::transaction(
            function () use ($data) {
                $order = Order::create($data);
                $data['lines'] = array_map(
                    function ($line) use ($order, $data) {
                        $line = (array) $line;
                        $line['order_id'] = $order->id;
                        $line['stall_id'] = $data['stall_id'];
                        $line['stock_item_id'] = $line['itemId'];
                        $line['uom'] = $line['conversionId'];
                        $line['order_quantity'] = $line['quantity'];
                        $line['processed_quantity'] = 0;
                        $line['discount'] = 0;
                        $line['tax_id'] = $line['taxId'];
                        $line['tax_rate'] = $line['taxRate'];
                        $line['unit_exclusive'] = $line['unitExclPrice'];
                        $line['unit_inclusive'] = $line['unitInclPrice'];
                        $line['unit_tax'] = $line['unit_inclusive'] - $line['unit_exclusive'];
                        $line['total_exclusive'] = $line['order_quantity'] * $line['unit_exclusive'];
                        $line['total_inclusive'] = $line['order_quantity'] * $line['unit_inclusive'];

//                        dd($line);
                        unset(
                            $line['itemId'], $line['conversionId'], $line['quantity'], $line['taxId'], $line['taxRate'],
                            $line['unitExclPrice'], $line['unitInclPrice'], $line['totalExcl'], $line['totalIncl'],
                            $line['totalTax']
                        );

                        return $line;
                    },
                    $data['lines']);
                OrderLine::insert($data['lines']);
            });

        flash('Successfully created a new purchase order');

        return redirect()->route('purchaseOrder.index');
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $order = Order::with(['lines'])->findOrFail($id);

        return view('purchase-order.show')
            ->with('order', $order);

        return view('purchase-order.show')->with('id', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $items = StockItem::with(
                ['conversions', 'buyingTax' => function ($builder) {
                    return $builder->select(['id', 'rate']);
                }])
                ->get(['name', 'id', 'code', 'stocking_uom', 'buying_tax']);

            $order = Order::with(['lines'])->findOrFail($id);

            return Response::json(
                [
                    'order'     => $order,
                    'items'     => $items,
                    'uoms'      => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
                    'suppliers' => Supplier::active()->get(['id', 'name', 'account_number']),
                    'stalls'    => Stall::all()
                ]);
        }

        return view('purchase-order.edit')
            ->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['lines'] = json_decode($data['lines']);
        $data['account_id'] = $request->get('supplier_id');
        $data['user_id'] = Auth::id();
        $data['document_type'] = Order::PURCHASE_ORDER;
        $data['document_status'] = Order::STATUS_UNPROCESSED;
        $data['total_exclusive'] = 0;
        $data['total_inclusive'] = 0;
        $data['total_tax'] = 0;
        if (! $data['due_date']) {
            $data['due_date'] = Carbon::parse($request->get('order_date'));
        }

        foreach ($data['lines'] as $line) {
            $data['total_exclusive'] += $line->totalExcl;
            $data['total_inclusive'] += $line->totalIncl;
            $data['total_tax'] += $line->totalTax;
        }

        \DB::transaction(
            function () use ($data, $id) {
                $order = Order::findOrFail($id);
                $order->update($data);
                OrderLine::where('order_id', $id)->delete();

                $data['lines'] = array_map(
                    function ($line) use ($order, $data) {
                        $line = (array) $line;
                        $line['order_id'] = $order->id;
                        $line['stall_id'] = $data['stall_id'];
                        $line['stock_item_id'] = $line['itemId'];
                        $line['uom'] = $line['conversionId'];
                        $line['order_quantity'] = $line['quantity'];
                        $line['processed_quantity'] = 0;
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
                            $line['totalTax']
                        );

                        return $line;
                    },
                    $data['lines']);

                OrderLine::insert($data['lines']);
            });

        flash('Successfully edited the purchase order');

        return redirect()->route('purchaseOrder.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
