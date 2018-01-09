<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     *
     */
    protected $data;
    protected  $lowstock;
    protected $date_today;
    protected $dailyInventory;
    protected  $dailySales;
    public function __construct()
    {
        $data=DB::table("stalls")->get();
        $this->data=$data;

        $low_stocks=DB::table('stalls')
                ->join('stocks','stocks.stall_id','=','stalls.id')
                ->join('stock_items','stock_items.id','=','stocks.item_id')
                ->select('stalls.name as stall_name','stocks.*','stock_items.*')
                ->where('quantity_on_hand','<=','50')
                ->get();
           $now=Carbon::now();
           $this->lowstock=$low_stocks;
           $this->date_today=$now;

        $daily_inventory=DB::table('stalls')
            ->join('stocks','stocks.stall_id','=','stalls.id')
            ->join('stock_items','stock_items.id','=','stocks.item_id')
            ->select('stalls.name as stall_name','stocks.*','stock_items.*')
            ->get();
        $this->dailyInventory=$daily_inventory;

        $whole_day = Carbon::now()->startOfDay();
        $daily_sales=DB::table('sales')
            ->join('stalls','stalls.id','=','sales.stall_id')
            ->where('sales.created_at','>=',$whole_day)->get();
     $this->dailySales=$daily_sales;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
            {

//        return $this->markdown('emails.orders.shipped')
//            ->attach(public_path('emails/invoice.pdf'),[
//                'as'=>'test.pdf',
//                'mime'=>'application/pdf'
//            ])
//            ->with("data",$this->data )->with('amount',85555);

                return $this->markdown('emails.orders.daily_report')
                     ->with("low_stocks",$this->lowstock)->with('date',$this->date_today)
                 ->with("daily_inventory",$this->dailyInventory)->with('date',$this->date_today)
                 ->with('daily_sales',$this->dailySales);

    }
}
