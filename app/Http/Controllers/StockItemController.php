<?php

namespace App\Http\Controllers;

use Response;
use SmoDav\Factory\StockItemFactory;
use SmoDav\Models\PriceListName;
use SmoDav\Models\StockItem;
use Illuminate\Http\Request;
use SmoDav\Models\Tax;
use SmoDav\Models\UnitOfMeasure;

class StockItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('stockitems.index')
            ->with('items', StockItem::all([
                'id', 'unit_cost', 'code', 'barcode', 'name', 'is_active', 'stocking_uom', 'has_conversions'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        if (request()->ajax()) {
            return Response::json([
                'taxes' => Tax::active()->get(['id', 'code', 'rate']),
                'uoms' => UnitOfMeasure::active()->get(['id', 'name', 'system_install']),
                'priceLists' => PriceListName::active()->get(['id', 'name'])
            ]);
        }

        return view('stockitems.create')
            ->with('uoms', UnitOfMeasure::active()->get(['id', 'name']))
            ->with('taxes', Tax::active()->get(['id', 'code', 'rate']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StockItemFactory::create($request);

        flash('Successfully added new stock item.', 'success');

        return redirect()->route('stockItem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function show(StockItem $stockItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function edit(StockItem $stockItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockItem $stockItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockItem $stockItem)
    {
        //
    }
}
