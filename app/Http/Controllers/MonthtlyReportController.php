<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use SmoDav\Models\Sale;
class MonthtlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //one month / 30 days
        $date = Carbon::now()->subDays(30)->startOfDay();
        $sales=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.created_at','>=',$date)
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

        $product=DB::table('sales')
            ->join('stock_items','stock_items.id','=','sales.stock_item_id')
            ->groupBy('sales.stock_item_id')
            ->get();
        $selectedProduct = Sale::first()->stock_item_id;

        return view('reports.monthly',compact('sales','pay','selectedRole','selectedProduct','product'));   //
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

    public function monthlySummary() {

        Excel::create('Monthly Sales Report', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {

                //one month / 30 days
                $date = Carbon::now()->subDays(30)->startOfDay();
                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->where('sales.created_at','>=',$date)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function monthlySummaryType($id) {

        Excel::create('Monthly Sales Report', function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use ($id){


                //one month / 30 days
                $date = Carbon::now()->subDays(30)->startOfDay();
                     $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->leftJoin('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                    ->where('sales.transaction_type_id','=',$id)
                    ->where('sales.created_at','>=',$date)
                    ->get();
dd($sales);
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

    public function monthlySummaryProduct($id) {

        Excel::create('Monthly Sales Report', function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use ($id){


                //one month / 30 days
                $date = Carbon::now()->subDays(30)->startOfDay();
                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->leftJoin('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                    ->leftJoin('stock_items','stock_items.id','=','sales.stock_item_id')
                    ->select('stalls.name','sales.stock_name','sales.totalExclPrice','sales.code','sales.created_at','sales.weight','transaction_types.mop')
                    ->where('sales.stock_item_id','=',$id)
                    ->where('sales.created_at','>=',$date)
                    ->get();
dd($sales);
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
        $breakdown = new Sale;
        $breakdown->transaction_type_id = $request->transaction_type_id;
        $ids = $breakdown['transaction_type_id'];
        //one month / 30 days
        $date = Carbon::now()->subDays(30)->startOfDay();
        $mode=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.transaction_type_id', '=', $ids)
            ->where('sales.created_at','>=',$date)->get();
        //dd($mode);

        return view('reports.search_monthly_transaction', compact('mode','ids'));
    }

    public function storeMonthlyProduct(Request $request)
    {

        $breakdown = new Sale;
        $breakdown->stock_item_id = $request->stock_item_id;
        $p_id = $breakdown['stock_item_id'];
        //one month / 30 days
        $date = Carbon::now()->subDays(30)->startOfDay();
        $mode=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.transaction_type_id', '=', $p_id)
            ->where('sales.created_at','>=',$date)->get();
        //dd($mode);

        return view('reports.search_monthly_product', compact('mode','p_id'));
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
