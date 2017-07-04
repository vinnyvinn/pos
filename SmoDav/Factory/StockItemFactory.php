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

            $prices = self::preparePrices($request, $stockItem);

            foreach ($prices as $price) {
                $stockItem->prices()->create((array) $price);
            }
        }, 3);
    }

    public static function update(StockItem $stockItem, Request $request)
    {
        return DB::transaction(function () use ($request, $stockItem) {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            $stockItem->update($data);
            $conversions = json_decode($request->get('conversions'));
            $stockItem->conversions()->delete();

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

            $prices = self::preparePrices($request, $stockItem);
            $stockItem->prices()->delete();

            foreach ($prices as $price) {
                $stockItem->prices()->create((array) $price);
            }
        }, 3);
    }

    public static function preparePrices($request, $stockItem)
    {
        $mapped = [];
        foreach ($request->get('prices') as $key => $values) {
            $priceList = substr($key, 6);
            foreach ($values as $conversion => $price) {
                $unit = substr($conversion, 5);
                $mapped[] = [
                    'price_list_name_id' => $priceList,
                    'stock_item_id' => $stockItem->id,
                    'unit_conversion_id' => $unit,
                    'inclusive_price' => $price,
                    'exclusive_price' => 0,
                    'tax' => 0
                ];
            }
        }

        return $mapped;
    }
}
