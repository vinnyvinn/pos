<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\Stall;
use Log;
use DB;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::table('logs')->insert(array(
                'name' => \Auth::user()->username,
                'email' => \Auth::user()->email,
                'login_at' => date('Y-m-d H:i:s')
            )
        );
        return view('checkin')->with('stalls', Stall::all(['id', 'name']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->session()->put('stall_id', $request->get('stall_id'));

        return redirect('/sale/create');
    }

    public function openStall()
    {
        return view('openStall');
    }
}
