<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\Stall;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkin')->with('stalls', Stall::all(['id', 'name']));
    }

    public function store(Request $request)
            {
               // dd($request->all());
                 session()->put('stall_id', $request->get('stall_id'));

        return redirect('/sale/create');
    }
}
