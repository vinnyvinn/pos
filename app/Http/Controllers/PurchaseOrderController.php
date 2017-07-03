<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        $order = Order::with()
        return view('purchase-order.index')->with('suppliers', Supplier::all())
        ->with('stalls', Stall::all())->with('orders', Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (request()->ajax()) {
            $items = StockItem::with(['conversions', 'buyingTax' => function ($builder) {
                return $builder->select(['id', 'rate']);
            }])
                ->get(['name', 'id', 'code', 'stocking_uom', 'buying_tax']);

            return Response::json([
                'items' => $items,
                'uoms' => UnitOfMeasure::active()->get(['id', 'name'])->keyBy('id'),
                'suppliers' => Supplier::active()->get(['id', 'name', 'account_number'])
            ]);
        }

        return view('purchase-order.create')->with('orders', Order::all())
            ->with('orderLines', OrderLine::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
