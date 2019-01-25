<?php

namespace SmoDav\Models;

use App\ProductSubcategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stall extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'location'
    ];

//    protected static function boot()
//    {
//        parent::boot();
//
//        self::created(function ($stall) {
//            self::createStock($stall);
//        });
//    }
//
//
//    private static function createStock($stall)
//    {
//        $items = ProductSubcategory::all(['id'])
//            ->map(function ($item) use ($stall) {
//                return [
//                    'stall_id' => $stall->id,
//                   // 'item_id' => $item->id,
//                    'quantity_on_hand' => 0,
//                  //  'quantity_reserved' => 0,
//                    'created_at' => Carbon::now(),
//                    'updated_at' => Carbon::now(),
//                ];
//            })
//            ->toArray();
//
//        Stock::insert($items);
//    }

}
