<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmoDav\Models\PettyCashType;

class pettyCashTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petty-cash.types.index')->with('pettyCashTypes', PettyCashType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petty-cash.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PettyCashType::create($request->all());

        flash('Successfully created a new petty cash type');
        return redirect()->route('pettyCashTypes.index');
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
        return view('petty-cash.types.edit')->with('type', PettyCashType::findOrFail($id));
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
        $type = PettyCashType::findOrFail($id);

        $type->update($data);

        flash('Successfully edited the petty cash type');

        return redirect()->route('pettyCashTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PettyCashType::findOrFail($id)->delete();

        flash('Successfully deleted petty cash type');
        return redirect()->route('pettyCashTypes.index');
    }
}
