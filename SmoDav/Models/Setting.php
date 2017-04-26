<?php

namespace SmoDav\Models;

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
        AVERAGE_COSTING = 'Average Cost',
        LATEST_COSTING = 'Latest Cost',
        MANUAL_COSTING = 'Manual Cost Entry';

    protected $fillable = [
        'inventory_control_method', 'costing_method', 'enable_loyalty', 'enable_gift_cards', 'enable_bundles',
        'enable_happy_hour_sales'
    ];

    public static function current()
    {
        return self::getCache();
    }

    public static function value($key)
    {
        return self::getCache()->$key;
    }

    private static function getCache()
    {
        return Cache::remember(self::CACHE_KEY, 60, function () {
            return Setting::first();
        });
    }

    public static function reCache()
    {
        Cache::forget(self::CACHE_KEY);
        return Cache::remember(self::CACHE_KEY, 60, function () {
            return Setting::first();
        });
    }
}
