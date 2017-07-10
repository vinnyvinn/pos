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
class SaleController extends Controller
{
    public function index()
    {
        return view('sale.index', ['sales' => Order::where('document_type', Order::INVOICE)->orderBy('id', 'desc')->get()]);
    }
    public function create()
    {
      $stallId = 1; // TODO: Change this to use session

      if (request()->ajax()) {
          $stockItems = StockItem::forSale($stallId);
          return response()->json([
            'stock'=> $stockItems,
            'uoms' => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
            'customers'=> Customer::get(['name', 'id'])
          ]);
      }
      return view('sale.create');
    }
    public function store(Request $request)
    {
      // TODO: Change this to use session
      // return response()->json($request->all());
      \DB::transaction(function () use($request) {
        $sale = Order::create([
          'user_id'=> \Auth::user()->id,
          'account_id' => $request->customer_id,
          'stall_id' => 1,
          'description' => $request->description,
          'document_type' => Order::INVOICE,
          'total_exclusive' => $request->total_exclusive,
          'total_inclusive' => $request->total_inclusive,
          'total_tax' => $request->total_tax
        ]);
        foreach ($request->salesLines as $index => $value) {
          if (!$value['quantity']) {
              return response()->json(['error'=>'please Input Valid quantity!']);
          }

          $sales[] = [];
            $item_in_stock = Stock::where('item_id', $value['id'])->where('stall_id', 1);
            $conversion = UnitConversion::where('stock_item_id', $value['id'])
                              ->get(['stocking_unit_id', 'stocking_ratio', 'converted_ratio'])->first();

          if ($conversion->stocking_unit_id == $value['unit_conversion_id']) {
              $stock_quantity = $item_in_stock->first()->quantity_on_hand;
              $new_stock_quantity = $item_in_stock->first()->quantity_on_hand - $value['quantity'];
            if ($new_stock_quantity < 0) {
                $new_stock_quantity = 0;
            }
            $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);
          }
          else{
            $stock_quantity = $item_in_stock->first()->quantity_on_hand;
            $units_sold = ($value['quantity'] * ($conversion->converted_ratio/ $conversion->stocking_ratio));
            $new_stock_quantity = $item_in_stock->first()->quantity_on_hand - $units_sold;
            $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);
          }

            $sales[$index] = [
              'sale_id' => $sale->id,
              'unit_conversion_id' => $value['unit_conversion_id'],
              'stock_item_id' => $value['id'],
              'stock_name' => $value['name'],
              'code' =>$value['code'],
              'quantity' => $value['quantity'],
              'tax_rate' => 0,
              'unit_tax' => 0,
              'unitExclPrice' => $value['unitExclPrice'],
              'unitInclPrice' => $value['unitInclPrice'],
              'totalInclPrice' => $value['totalIncl'],
              'totalExclPrice' => $value['totalExcl'],
              'total_tax' => $value['totalTax']
            ];
        }

        Sale::insert($sales);
});

      return response()->json(['message' => 'Successfully Completed Sale!']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
