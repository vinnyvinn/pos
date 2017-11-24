<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\Sale;
use DB;
use SmoDav\Models\StockItem;
class TransactionTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//     $users=DB::table('stock_items')->get();
//     $stocks=StockItem::pluck('name','id');
     //dd($tt);
   // echo $users;
        $search=\Request::get('name');
        $stocks=DB::table('stock_items')->where('name','like','%'.$search.'%')->get();
     return view('reports.search',compact('stocks'));   //
    }


    public function LoadJs(Request $request)
    {
//        $users=DB::table('stock_items')->get();
//        return $users;
        $search=\Request::get('name');
        $stocks=DB::table('stock_items')->where('name','like','%'.$search.'%')->get();
        return response()->json($stocks);
        // dd($users);
        //return view('reports.search',compact('users'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $breakdown = new Sale;
        $breakdown->transaction_type_id = $request->transaction_type_id;
        $ids = $breakdown['transaction_type_id'];
        $mode=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.transaction_type_id', '=', $ids)
            ->get();
        //dd($mode);

        return view('reports.custom_search', compact('mode','ids'));
    }

    public function storeProduct(Request $request)
    {
        $breakdown = new Sale;
        $breakdown->stock_item_id = $request->stock_item_id;
        $p_id = $breakdown['stock_item_id'];
        $mode=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.transaction_type_id', '=', $p_id)
           ->get();
        //dd($mode);

        return view('reports.custom_products', compact('mode','p_id'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
