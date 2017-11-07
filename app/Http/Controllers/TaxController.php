<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxRequest;
use Illuminate\Http\Request;
use SmoDav\Models\Tax;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('tax.index')->with('taxes', Tax::all(['id', 'code', 'description', 'rate', 'is_active']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tax.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Tax::create($data);

        flash('Successfully added new tax type.', 'success');

        return redirect()->route('tax.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        return view('tax.edit')->with('tax', $tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaxRequest  $request
     * @param  Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRequest $request, Tax $tax)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $tax->update($data);

        flash('Successfully edited tax type.', 'success');

        return redirect()->route('tax.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();

        flash('Successfully deleted tax type.');

        return redirect()->route('tax.index');
    }
}
