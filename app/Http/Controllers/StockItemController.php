<?php

namespace App\Http\Controllers;

use Response;
use SmoDav\Factory\StockItemFactory;
use SmoDav\Models\PriceList;
use SmoDav\Models\PriceListName;
use SmoDav\Models\Stock;
use SmoDav\Models\StockItem;
use Illuminate\Http\Request;
use SmoDav\Models\Tax;
use SmoDav\Models\UnitConversion;
use SmoDav\Models\UnitOfMeasure;

class StockItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        switch (request('status')) {
            case 'active':
                $products = StockItem::where('is_active', 1)->get();
                $title = 'Active';
                break;
            case 'inactive':
                $products = StockItem::where('is_active', 0)->get();
                $title = 'Inactive';
                break;
            default:
                $products = StockItem::all([
                    'id', 'unit_cost', 'code', 'barcode', 'name', 'is_active', 'stocking_uom', 'has_conversions'
                ]);
                $title = 'All';
                break;
        }
        return view('stockitems.index')
            ->with('items', $products)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        if (request()->ajax()) {
            return Response::json([
                'taxes' => Tax::active()->get(['id', 'code', 'rate']),
                'uoms' => UnitOfMeasure::active()->get(['id', 'name', 'system_install']),
                'priceLists' => PriceListName::active()->get(['id', 'name'])
            ]);
        }

        return view('stockitems.create')
            ->with('uoms', UnitOfMeasure::active()->get(['id', 'name']))
            ->with('taxes', Tax::active()->get(['id', 'code', 'rate']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->get('barcode')) {
            $request->merge([
                'barcode' => str_random(8)
            ]);
        }
        StockItemFactory::create($request);

        flash('Successfully added new stock item.', 'success');

        return redirect()->route('stockItem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function show(StockItem $stockItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $item = StockItem::with(['conversions', 'prices'])->find($id);
            return Response::json([
                'taxes' => Tax::active()->get(['id', 'code', 'rate']),
                'uoms' => UnitOfMeasure::active()->get(['id', 'name', 'system_install']),
                'priceLists' => PriceListName::active()->get(['id', 'name']),
                'item' => $item
            ]);
        }

        return view('stockitems.edit')->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockItem $stockItem)
    {
        if (!$request->get('barcode')) {
            $request->merge([
                'barcode' => str_random(8)
            ]);
        }
        StockItemFactory::update($stockItem, $request);

        flash('Successfully edited stock item.', 'success');

        return redirect()->route('stockItem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SmoDav\Models\StockItem  $stockItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockItem $stockItem)
    {
        $stockItem->delete();

        flash('Successfully deleted stock item.', 'success');

        return redirect()->route('stockItem.index');
    }

    public function importExcel(Request $request)
    {
//        dd($request->all());
        if (! $request->hasFile('products')) {
            flash('Please select a file to upload first');

            return redirect()->route('stockItem.index');
        }
        $file = $request->file('products');

        $excel = \Excel::load($file)->get()->toArray();
        $excel = count($excel) ? $excel[0] : [];

        if ($excel == null) {
            flash('The file you selected is empty please select another one', 'error');

            return redirect()->back();
        }
        $expectedColumns = 6;
        $sampleProduct = $excel[0];

        if (count(array_keys($sampleProduct)) > $expectedColumns) {
            flash('The file you uploaded did not match the expected format, Please upload a new one', 'error');

            return redirect()->back();
        }
        $existing = StockItem::all(['barcode'])->map(function ($stockItem) {
            return $stockItem->barcode;
        })->toArray();

        $tax = Tax::first();

        $excel = array_map(function ($item) use ($existing, $tax) {
            dd($item);
            $values = array_values($item);
            if (in_array($values[5], $existing)) {
                return null;
            }
            return [
                'code' => $values[0],
                'name' => $values[1],
                'description' => $values[2],
                'unit_cost' => $values[3],
                'selling_price' => $values[4],
                'barcode' => $values[5],
                'buying_tax' => $tax->id,
                'selling_tax' => $tax->id,
                'credit_note_tax' => 1,
                'is_active' => true,
                'stocking_uom' => 1,
                'selling_uom' => 1,
                'has_conversions' => false,
                'is_serial_item' => false,
                'is_expiry_item' => false
            ];
        }, $excel);
        $excel = array_filter($excel, function ($item) {
            return ! is_null($item);
        });
        foreach ($excel as $item) {
            $stockItem = StockItem::create($item);
            $exclusive = (float) $item['selling_price'] / 1.16;
            PriceList::create([
                'price_list_name_id' => 1,
                'stock_item_id' => $stockItem->id,
                'unit_conversion_id' => 1,
                'inclusive_price' => $item['selling_price'],
                'exclusive_price' => $exclusive,
                'tax' => ((float) $item['selling_price']) - $exclusive
            ]);
        }

        flash('Successfully imported items', 'success');

        return redirect()->back();
    }
}
