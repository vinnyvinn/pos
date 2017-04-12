<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceListRequest;
use Illuminate\Http\Request;
use SmoDav\Models\PriceListName;

class PriceListNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('price-list-name.index')
            ->with('lists', PriceListName::all(['id', 'name', 'is_active', 'description']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('price-list-name.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PriceListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PriceListRequest $request)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        PriceListName::create($data);

        flash('Successfully added new price list.', 'success');

        return redirect()->route('price-list-name.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  PriceListName  $priceListName
     * @return \Illuminate\Http\Response
     */
    public function show(PriceListName $priceListName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $priceListName = PriceListName::findOrFail($id);

        return view('price-list-name.edit')->with('list', $priceListName);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PriceListRequest $request
     * @param                   $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PriceListRequest $request, $id)
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $priceListName = PriceListName::findOrFail($id);
        $priceListName->update($data);

        flash('Successfully updated price list.', 'success');

        return redirect()->route('price-list-name.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priceListName = PriceListName::findOrFail($id);
        $priceListName->delete();
        flash('Successfully deleted price list.');

        return redirect()->route('price-list-name.index');
    }
}
