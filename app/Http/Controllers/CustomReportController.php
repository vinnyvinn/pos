<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use SmoDav\Models\Sale;

class CustomReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //custom
        $sales=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->select([
                'sales.created_at', 'stock_item_id', 'stall_id', 'stock_name', 'weight', 'code',
                'totalInclPrice', 'totalExclPrice', 'name'
            ])
            ->get();

            $pay=DB::table('sales')
                ->join('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                ->groupBy('sales.transaction_type_id')
                ->get();
        $selectedRole = Sale::first()->transaction_type_id;
            //dd($selectedRole);
        $product=DB::table('sales')
            ->join('stock_items','stock_items.id','=','sales.stock_item_id')
            ->groupBy('sales.stock_item_id')
            ->get();
            $selectedProduct = Sale::first()->stock_item_id;
        //dd($selectedProduct);
        return view('reports.custom',compact('sales','pay','selectedRole','product','selectedProduct'));   // //
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

    public function customSummary() {

        Excel::create('Custom Sales Report', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {


                //custom

                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->get();

                $arr = array();
                foreach ($sales as $sale) {

                    $data = array($sale->name, $sale->stock_name, $sale->weight,
                        $sale->code, $sale->totalExclPrice,$sale->created_at
                    );
                    array_push($arr, $data);
                }

//set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('STALL', 'PRODUCT', 'WEIGHT',
                        'CODE', 'TOTAL PRICE','DATE'
                    )
                );
            });
        })->export('xls');
    }

    public function customSummaryType($id) {

        Excel::create('Custom Sales Report', function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use ($id){


                //custom

                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->leftJoin('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                    ->where('sales.transaction_type_id','=',$id)
                    ->get();

                $arr = array();
                foreach ($sales as $sale) {

                    $data = array($sale->name, $sale->stock_name, $sale->weight,
                        $sale->code, $sale->totalExclPrice,$sale->mop,$sale->created_at
                    );
                    array_push($arr, $data);
                }

//set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('STALL', 'PRODUCT', 'WEIGHT',
                        'CODE', 'TOTAL PRICE','PAYMENT MODE','DATE'
                    )
                );
            });
        })->export('xls');
    }

    public function customSummaryProduct($id) {

        Excel::create('Custom Sales Report', function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use ($id){


                //custom

                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->leftJoin('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                    ->leftJoin('stock_items','stock_items.id','=','sales.stock_item_id')
                    ->select('stalls.name','sales.stock_name','sales.totalExclPrice','sales.code','sales.created_at','sales.weight','transaction_types.mop')
                    ->where('sales.stock_item_id','=',$id)
                    ->get();

                $arr = array();
                foreach ($sales as $sale) {

                    $data = array($sale->name, $sale->stock_name, $sale->weight,
                        $sale->code, $sale->totalExclPrice,$sale->mop,$sale->created_at
                    );
                    array_push($arr, $data);
                }

//set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('STALL', 'PRODUCT', 'WEIGHT',
                        'CODE', 'TOTAL PRICE','PAYMENT MODE','DATE'
                    )
                );
            });
        })->export('xls');
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
