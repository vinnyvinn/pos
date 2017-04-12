<?php

namespace App\Http\Controllers;

use App\Http\Requests\UOMRequest;
use SmoDav\Models\UnitOfMeasure;
use Illuminate\Http\Request;

class UnitOfMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('uom.index')
            ->with('units', UnitOfMeasure::all(['id', 'system_install', 'description', 'name', 'is_active']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UOMRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UOMRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        UnitOfMeasure::create($data);

        flash('Successfully added new unit of measure.', 'success');

        return redirect()->route('unitOfMeasure.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SmoDav\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(UnitOfMeasure $unitOfMeasure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SmoDav\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitOfMeasure $unitOfMeasure)
    {
        return view('uom.edit')->with('unit', $unitOfMeasure);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UOMRequest  $request
     * @param  \SmoDav\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function update(UOMRequest $request, UnitOfMeasure $unitOfMeasure)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $unitOfMeasure->update($data);

        flash('Successfully updated unit of measure.', 'success');

        return redirect()->route('unitOfMeasure.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SmoDav\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitOfMeasure $unitOfMeasure)
    {
        $unitOfMeasure->delete();

        flash('Successfully deleted unit of measure.');

        return redirect()->route('unitOfMeasure.index');
    }
}
