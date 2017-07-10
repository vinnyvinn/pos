<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\UnitOfMeasure;
use SmoDav\Models\StockItem;
use SmoDav\Models\Stock;
use SmoDav\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        return view('sale.index', ['sales' => Sale::orderBy('id', 'desc')->get()]);
    }

    public function create()
    {
        $stallId = 1; // TODO: Change this to use session

        if (request()->ajax()) {
            $stockItems = StockItem::forSale($stallId);

            return response()->json([
                'stock' => $stockItems,
                'uoms'  => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
            ]);
        }

        return view('sale.create');
    }

    public function store(Request $request)
    {
        // TODO: Change this to use session
        foreach ($request->all() as $index => $value) {
            if (!$value['quantity']) {
                return response()->json(['error' => 'please Input Valid quantity!']);
            }
            $sales[] = [];
            $item_in_stock = Stock::where('item_id', $value['id'])->where('stall_id', 1);
            $stock_quantity = $item_in_stock->first()->quantity_on_hand;
            $new_stock_quantity = $item_in_stock->first()->quantity_on_hand - $value['quantity'];
            if ($new_stock_quantity < 0) {
                $new_stock_quantity = 0;
            }
            $item_in_stock->update(['quantity_on_hand' => $new_stock_quantity]);
            $sales[$index] = [
                'unit_conversion_id' => $value['uom'],
                'uom'                => $value['uom'],
                'stock_item_id'      => $value['id'],
                'stock_name'         => $value['name'],
                'quantity'           => $value['quantity'],
                'unitExclPrice'      => $value['unitExclPrice'],
                'unitInclPrice'      => $value['unitInclPrice'],
                'totalInclPrice'     => $value['totalIncl'],
                'totalExclPrice'     => $value['totalExcl'],
                'total_tax'          => $value['totalTax'],
            ];

        }
        Sale::insert($sales);

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
