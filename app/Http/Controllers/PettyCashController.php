<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use SmoDav\Models\PettyCash;
use SmoDav\Models\PettyCashType;

class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petty-cash.index')->with('pettyCash', PettyCash::with('user', 'pettyCashType')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petty-cash.create')->with('users', User::all())->with('pettyCashTypes', PettyCashType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::id();

        PettyCash::create($data);

        flash('Successfully created a petty cash');
        return redirect()->route('pettyCash.index');
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
        return view('petty-cash.edit', [
            'pettyCash' => PettyCash::with('user', 'pettyCashType')->findOrFail($id),
            'pettyCashTypes' => PettyCashType::all()
        ]);
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
        $pettyCash = PettyCash::with('user', 'pettyCashType')->findOrFail($id);
        $pettyCash->update($data);

        flash('Successfully edited the petty cash type');
        return redirect()->route('pettyCash.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PettyCash::with('user', 'pettyCashType')->findOrFail($id)->delete();

        flash('Successfully deleted the petty cash');
        return redirect()->route('pettyCash.index');
    }
}
