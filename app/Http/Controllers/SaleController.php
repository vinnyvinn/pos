<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SmoDav\Models\UnitOfMeasure;
use SmoDav\Models\StockItem;
use SmoDav\Models\Stock;
use SmoDav\Models\Sale;
use SmoDav\Models\Order;
use SmoDav\Models\UnitConversion;
use SmoDav\Models\Customer;
use SmoDav\Models\PaymentTypes;
use SmoDav\Models\Tax;
use PDF;

class SaleController extends Controller
{

    public function index()
    {
        return view(
            'sale.index',
            ['sales' => Order::with(['stall', 'customer', 'paymentType'])
                ->where('document_type', Order::INVOICE)
                ->orderBy('id', 'desc')
                ->get(), 'stall_id' => session()->get('stall_id')]);
    }

    public function create()
    {
        $stallId =  session()->get('stall_id');  // TODO: Change this to use session

        if (request()->ajax()) {
            $stockItems = StockItem::forSale($stallId);

            return response()->json(
                [
                    'stock'         => $stockItems,
                    'uoms'          => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
                    'customers'     => Customer::get(
                        ['name', 'account_balance', 'account_number', 'credit_limit', 'id', 'is_credit']),
                    'payment_types' => PaymentTypes::get(['name', 'slug', 'id', 'is_credit']),
                    'taxes'         => Tax::active()->get(['id', 'code', 'rate']),
                    "products"      => StockItem::all()
                ]);
        }

        return view('sale.create');
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        // TODO: Change this to use session
        $customer = Customer::findOrfail($request->customer_id);
        $sale_id = null;
        $sale = \DB::transaction(
            function () use ($request, $customer) {
                if ($customer->is_credit == 1) {
                    $balance = $request->credit;
                    $balance += $customer->account_balance;
                    $customer->update(['account_balance' => $balance]);
                }

                $sale = Order::create(
                    [
                        'user_id'         => \Auth::user()->id,
                        'account_id'      => $request->customer_id,
                        'stall_id'        => session()->get('stall_id'),
                        'description'     => $request->description,
                        'document_type'   => Order::INVOICE,
                        'total_exclusive' => $request->total_exclusive,
                        'total_inclusive' => $request->total_inclusive,
                        'total_tax'       => $request->total_tax,
                        'mpesa'           => json_encode($request->mpesa),
                        'cash'            => $request->cash,
                        'credit'          => $request->credit,
                        'balance'         => $request->balance,
                        'notes'           => $request->notes
                    ]);
//                $sale_id = $sale->id;
                foreach ($request->salesLines as $index => $value) {
                    if (! $value['quantity']) {
                        return response()->json(['error' => 'please Input Valid quantity!']);
                    }

                    $sales[] = [];

                    $item_in_stock = Stock::where('item_id', $value['id'])->where('stall_id', 1);
                    $conversion = UnitConversion::where('stock_item_id', $value['id'])
                        ->where('converted_unit_id', $value['unit_conversion_id'])
                        ->get(['stocking_unit_id', 'stocking_ratio', 'converted_ratio'])->first();

                    if (! $conversion) {
                        $stock_quantity = ($item_in_stock->first()) ? $item_in_stock->first()->quantity_on_hand : null;
                        $new_stock_quantity = ($item_in_stock->first()) ?
                                                $item_in_stock->first()->quantity_on_hand - $value['quantity'] :
                                                null;
                        if ($new_stock_quantity < 0) {
                            $new_stock_quantity = 0;
                        }
                        $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);
                    } else {
                        $stock_quantity = $item_in_stock->first()->quantity_on_hand;
                        $units_sold = ($value['quantity'] * ($conversion->converted_ratio / $conversion->stocking_ratio));
                        $new_stock_quantity = $item_in_stock->first()->quantity_on_hand - $units_sold;
                        if ($new_stock_quantity < 0) {
                            $new_stock_quantity = 0;
                        }
                        $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);

                    }

                    $sales[$index] = [
                        'sale_id'            => $sale->id,
                        'unit_conversion_id' => $value['unit_conversion_id'],
                        'stock_item_id'      => $value['id'],
                        'stock_name'         => $value['name'],
                        'code'               => $value['code'],
                        'quantity'           => $value['quantity'],
                        'tax_rate'           => $value['tax_rate'],
                        'unit_tax'           => $value['unitInclPrice'] - $value['unitExclPrice'],
                        'unitExclPrice'      => $value['unitExclPrice'],
                        'unitInclPrice'      => $value['unitInclPrice'],
                        'totalInclPrice'     => $value['totalIncl'],
                        'totalExclPrice'     => $value['totalExcl'],
                        'total_tax'          => $value['totalTax'],
                        'stall_id'           => session()->get('stall_id'),
                        'created_at'         => Carbon::now()
                    ];
                }

                Sale::insert($sales);

                return $sale;
            });

        if (isset($customer) && isset($sale)) {
            return response()->json(['message' => 'Sale Made Successfully!']);
        }

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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

    public function receipt($id)
    {
        $pdf = PDF::loadView(
            'sale.receipt',
            ['sale'  => Order::with(['sale.stock', 'customer'])->findOrfail($id),
             'taxes' => Tax::active()->get(['id', 'code', 'rate'])]);

        // return $pdf->stream(Carbon::now().'_receipt.pdf');
        return view(
            'sale.receipt',
            ['sale'  => Order::with(['sale.stock', 'customer'])->findOrfail($id),
             'taxes' => Tax::active()->get(['id', 'code', 'rate'])]);
    }

    public function credit()
    {
        return view('sale.credit-sale-receipt');
    }

    public function test()
    {
        return view('');
    }
}
