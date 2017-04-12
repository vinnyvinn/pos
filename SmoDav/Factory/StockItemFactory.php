<?php

namespace SmoDav\Factory;

use DB;
use Illuminate\Http\Request;
use SmoDav\Models\StockItem;

class StockItemFactory
{
    public static function create(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            $stockItem = StockItem::create($data);
            $conversions = json_decode($request->get('conversions'));

            if ($stockItem->has_conversions) {
                foreach ($conversions as $conversion) {
                    $stockItem->conversions()->create([
                        'stock_item_id' => $stockItem->id,
                        'stocking_unit_id' => $request->get('stocking_uom'),
                        'converted_unit_id' => $conversion->unit_b_id,
                        'converted_ratio' => $conversion->unit_b_quantity,
                        'stocking_ratio' => $conversion->unit_a_quantity
                    ]);
                }
            }

            $prices = self::preparePrices($request->get('prices'));

            foreach ($prices as $price) {
                $stockItem->prices()->create((array) $price);
            }
        }, 3);
    }

     /**
     * @param $requestPrices
     *
     * @return array
     */
    public static function preparePrices($requestPrices)
    {
        $prices = (array) json_decode($requestPrices);
        $prices = array_map(function ($price) {
            $unmapped = [];
            foreach ((array) $price as $item) {
                $unmapped[] = $item;
            }

            return $unmapped;
        }, $prices);

        $prices = array_flatten($prices);

        return $prices;
    }
}
