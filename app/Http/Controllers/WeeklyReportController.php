<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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
        $sales=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.created_at','>=',$date)
            ->get();

        return view('reports.weekly',compact('sales'));   //
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
                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->where('sales.created_at','>=',$date)
                    ->get();

                $arr = array();
                foreach ($sales as $sale) {

                    $data = array($sale->name, $sale->stock_name, $sale->quantity,
                        $sale->code, $sale->totalExclPrice,$sale->created_at
                    );
                    array_push($arr, $data);
                }

//set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('STALL', 'PRODUCT', 'QUANTITY',
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
