<?php

namespace App\Http\Controllers;

use App\Http\Requests\StallRequest;
use Illuminate\Http\Request;
use SmoDav\Models\Stall;

class StallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('stall.index')->with('stalls', Stall::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('stall.create')->with('stall', Stall::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StallRequest $request)
    {
        $stall = $request->all();

        Stall::create($stall);
        flash('Successfully saved the store');
        return redirect()->route('stall.index');
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
       return view('stall.edit')->with('stall', Stall::findOrFail($id));
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
        $data = $request->all();
        $stall = Stall::findOrFail($id);
        $stall->update($data);

        flash('Successfully edited the stall');
        return redirect()->route('stall.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Stall::findOrFail($id)->delete();
       flash('successfully deleted the stall');
       return redirect()->route('stall.index');
    }
}
