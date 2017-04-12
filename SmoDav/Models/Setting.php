<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const CACHE_KEY = 'POS_SETTING';

    const
        INVENTORY_CONTROL = 'inventory_control_method',
        COSTING = 'costing_method',
        LOYALTY = 'enable_loyalty',
        GIFT_CARDS = 'enable_gift_cards',
        BUNDLES = 'enable_bundles',
        HAPPY_SALES = 'enable_happy_hour_sales';

    const
        FIFO = "FIFO",
        LIFO = 'LIFO',
        NONE = 'None',
        AVERAGE_COSTING = 'Average Costing',
        LATEST_COSTING = 'Latest Costing',
        MANUAL_COSTING = 'Manual Costing';

    protected $fillable = [
        'inventory_control_method', 'costing_method', 'enable_loyalty', 'enable_gift_cards', 'enable_bundles',
        'enable_happy_hour_sales'
    ];

    public static function value($key)
    {
        return Cache::remember(self::CACHE_KEY, 60, function () use ($key) {
            return Setting::first()->$key;
        });
    }
}
