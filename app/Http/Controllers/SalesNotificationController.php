<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Mail;
use App\Jobs\TestQueue;
use Log;
class SalesNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ss=DB::table('stalls')
          ->join('stocks','stocks.stall_id','=','stalls.id')
          ->join('stock_items','stock_items.id','=','stocks.item_id')
          ->select('stalls.name as stall_name','stocks.*','stock_items.*')
          ->first();


        $date = Carbon::now()->startOfDay();
        $sales=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.created_at','>=',$date)->first();


dd($sales);

      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function dailyInventory()
    {
        Excel::create('Daily Inventory Report', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {



                $stocks=DB::table('stalls')
                    ->join('stocks','stocks.stall_id','=','stalls.id')
                    ->join('stock_items','stock_items.id','=','stocks.item_id')
                    ->select('stalls.name as stall_name','stocks.*','stock_items.*')
                    ->get();

                $now=Carbon::now();
                $arr = array();
                foreach ($stocks as $stock) {

                    $data = array($stock->stall_name, $stock->name, $stock->quantity_on_hand,
                        $stock->code,$now
                    );
                    array_push($arr, $data);
                }

//set the titles
                $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('STALL', 'PRODUCT', 'QUANTITY',
                        'CODE','DATE'
                    )
                );
            });
        })->export('xls');

    }

    public function dailySales()
    {
        Excel::create('Daily Sales Report', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {


                //one day (today)
                $date = Carbon::now()->startOfDay();
                $sales=DB::table('sales')
                    ->join('stalls','stalls.id','=','sales.stall_id')
                    ->where('sales.created_at','>=',$date)->get();

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

    public function create()
    {
        //
    }
    
public function  lowStock()
{
//
//            //one day (today)
//
//            $low_stocks=DB::table('stalls')
//                ->join('stocks','stocks.stall_id','=','stalls.id')
//                ->join('stock_items','stock_items.id','=','stocks.item_id')
//                ->select('stalls.name as stall_name','stocks.*','stock_items.*')
//                ->where('quantity_on_hand','<=','50')
//                ->get();
//           $now=Carbon::now();
//            $arr = array();
//            foreach ($low_stocks as $sale) {
//
//                $data = array($sale->stall_name, $sale->name, $sale->quantity_on_hand,
//                    $sale->code,$sale->created_at,$now
//                );
//                array_push($arr, $data);
//            }
//
////set the titles
//            $sheet->fromArray($arr, null, 'A1', false, false)->prependRow(array('STALL', 'PRODUCT', 'QUANTITY',
//                    'CODE', 'TOTAL PRICE','DATE'
//
//return view('');

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


    public function sendEmail() {
            Log::info("No Delay");
            TestQueue::dispatch()->delay(90);

//
//        $data = [
//            'name'=> 'vinnyvinny',
//            'email'=> 'kituyiv@gmail.com',
//            'body_message'=> 'great',
//        ];
//
//        Mail::send('emails.contact',$data, function($message) use ($data){
//
//            $message->from($data['email']);
//            $message->to('kituyiv@gmail.com');
//            $message->subject('great wow!');
//
//
//            //session::flash('success','Message Sent');
//            return redirect()->back();
//        });
     }

}
