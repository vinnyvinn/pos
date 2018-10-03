<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use SmoDav\Models\Sale;
use App\MenuDetail;

class WeeklyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
            {
                //one week / 7 days
        $date = Carbon::now()->subDays(7)->startOfDay();
                $menus = MenuDetail::where('created_at','>=',$date)->get();


        return view('reports.weekly',compact('menus'));   //
    }
   public function LoadWeekly()
   {


       $search=\Request::get('name');
       $product=DB::table('sales')
           ->join('stock_items','stock_items.id','=','sales.stock_item_id')
           ->where('name','like'.'%'.$search.'%')
           ->groupBy('sales.stock_item_id')
           ->get();
       return response()->json($product);
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
    public function weeklySummary() {

        Excel::create('Weekly Sales Report', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {

                //one week / 7 days
                $date = Carbon::now()->subDays(7)->startOfDay();
                $sales=MenuDetail::where('created_at','>=',$date)->get();

                $arr = array();
                foreach ($sales as $sale) {

                    $data = array($sale['item_name'], $sale['unit_price'], $sale['quantity'],
                        $sale['sub_total'], $sale['created_at']
                    );
                    array_push($arr, $data);
                }

//set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('Item', 'Unit Price', 'Quantity',
                        'SubTotal','DATE'
                    )
                );
            });
        })->export('xls');
    }

    public function weeklySummaryType($id) {

        Excel::create('Weekly Sales Report', function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use ($id){


                //custom
                $date = Carbon::now()->subDays(7)->startOfDay();
                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->leftJoin('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                    ->where('sales.transaction_type_id','=',$id)
                    ->where('sales.created_at','>=',$date)
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

    public function weeklySummaryProduct($id) {

        Excel::create('Weekly Sales Report', function($excel) use ($id) {

            $excel->sheet('Excel sheet', function($sheet) use ($id){


                //custom
                $date = Carbon::now()->subDays(7)->startOfDay();
                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->leftJoin('transaction_types','transaction_types.id','=','sales.transaction_type_id')
                    ->leftJoin('stock_items','stock_items.id','=','sales.stock_item_id')
                    ->select('stalls.name','sales.stock_name','sales.totalExclPrice','sales.code','sales.created_at','sales.weight','transaction_types.mop')
                    ->where('sales.stock_item_id','=',$id)
                    ->where('sales.created_at','>=',$date)
                    ->get();
                    //dd($sales);
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
        $date = Carbon::now()->subDays(7)->startOfDay();
        $mode=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.transaction_type_id', '=', $ids)
            ->where('sales.created_at','>=',$date)->get();
        //dd($mode);

        return view('reports.search_weekly_transaction', compact('mode','ids'));
    }

    public function storeWeeklyProduct(Request $request)
    {

        $breakdown = new Sale;
        $breakdown->stock_item_id = $request->stock_item_id;
        $p_id = $breakdown['stock_item_id'];
        $date = Carbon::now()->subDays(7)->startOfDay();
        $mode=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.transaction_type_id', '=', $p_id)
            ->where('sales.created_at','>=',$date)->get();
        //dd($mode);

        return view('reports.search_weekly_product', compact('mode','p_id'));
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
