<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Log;
use SmoDav\Models\PettyCash;
use SmoDav\Models\Sale;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
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
        $most_selling = Sale::join('stock_items', 'stock_items.id', '=', 'sales.stock_item_id')
         ->select(DB::raw('name,sum(quantity) as total_quantity'))
        ->groupBy('stock_item_id')
        ->orderBy('total_quantity', 'desc')
         ->first();
        $least_selling = Sale::join('stock_items', 'stock_items.id', '=', 'sales.stock_item_id')
         ->select(DB::raw('name,sum(quantity) as total_quantity'))
        ->groupBy('stock_item_id')
        ->orderBy('total_quantity', 'asc')
         ->first();

        // dd($max, $min);
        // $number = count($m_selling);
        // $max = $most_selling->name;
        // $min    = $least_selling->name;

        return view('welcome', compact('days', 'sales', 'customers', 'max', 'min', 'expenses'));
    }
}
