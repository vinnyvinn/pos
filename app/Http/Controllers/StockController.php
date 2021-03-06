<?php

namespace App\Http\Controllers;

use App\ProductSubcategory;
use Illuminate\Http\Request;
use SmoDav\Models\Stall;
use SmoDav\Models\Stock;
use SmoDav\Models\StockItem;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $stocks=ProductSubcategory::all();
        return view('stock.index',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//        dd(Stock::with('stall')->get());
        $stalls=Stall::all();
        $stock_items=ProductSubcategory::all();

        return view('stock.create',compact('stalls','stock_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->all());
        $stock = ProductSubcategory::where('stall_id', $request->get('stall_id'))
            ->where('id', $request->get('item_id'))
            ->firstOrFail();
        if(!$stock)
        {
            ProductSubcategory::create();
        }
//        dd($stock);
          $stock->increment('quantity_on_hand', $request->get('quantity_on_hand'));
        flash('Successfully created stock');

        return redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
