<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\UnitOfMeasure;
use SmoDav\Models\StockItem;
class SaleController extends Controller
{
    public function index()
    {
        $stallId = 1; // TODO: Change this to use session

        if (request()->ajax()) {
            $stockItems = StockItem::forSale($stallId);
            return response()->json([
              'stock'=> $stockItems,
              'uoms' => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id')
            ]);
        }
        return view('sale.index');
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
      // return response()->json($request->all());
      foreach ($request->all() as $value) {
        return response()->json($value);
      }
    }

    public function show($id)
    {
    }

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
}
