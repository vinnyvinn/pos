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
        switch (request('status')) {
            case 'active':
                $products = StockItem::where('is_active', 1)->get();
                $title = 'Active';
                break;
            case 'inactive':
                $products = StockItem::where('is_active', 0)->get();
                $title = 'Inactive';
                break;
            default:
                $products = StockItem::all([
                    'id', 'unit_cost', 'code', 'barcode', 'name', 'is_active', 'stocking_uom', 'has_conversions'
                ]);
                $title = 'All';
                break;
        }
        return view('stockitems.index')
            ->with('items', $products)->with('title', $title);
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
        $stock
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $item = StockItem::with(['conversions', 'prices'])->find($id);
            return Response::json([
                'taxes' => Tax::active()->get(['id', 'code', 'rate']),
                'uoms' => UnitOfMeasure::active()->get(['id', 'name', 'system_install']),
                'priceLists' => PriceListName::active()->get(['id', 'name']),
                'item' => $item
            ]);
        }

        return view('stockitems.edit')->with('id', $id);
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
        StockItemFactory::update($stockItem, $request);

        flash('Successfully edited stock item.', 'success');

        return redirect()->route('stockItem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockItem $stockItem)
    {
        $stockItem->delete();

        flash('Successfully deleted stock item.', 'success');

        return redirect()->route('stockItem.index');
    }
}
