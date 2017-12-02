<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Log;
use Carbon\Carbon;
use SmoDav\Models\PettyCash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Log::info("got here");


        return redirect('/');

    }

    public function dashboard()
    {
        $wks= Carbon::now()->subDays(7)->startOfDay();

        $days= DB::table('logs')->where('created_at', '>=', $wks->toDateTimeString())->count();
        $sales=DB::table('sales')->where('created_at', '>=', $wks->toDateTimeString())->sum('totalExclPrice');
        $customers=DB::table('customers')->count();
        $expenses = PettyCash::all('amount')->sum('amount');
        $m_selling=DB::table('sales')
         ->join('stock_items', 'stock_items.id', '=', 'sales.stock_item_id')
         ->select(DB::raw('count(sales.stock_item_id) as counts,stock_item_id,stock_items.name'))
         ->groupBy('sales.stock_item_id')
         ->get()->toArray();
        $number = count($m_selling);
//        $max    = $m_selling[0]->name;
//        $min    = $m_selling[$number-1]->name;

        return view('welcome', compact('days', 'sales', 'customers', 'max', 'min', 'expenses'));
    }
}
