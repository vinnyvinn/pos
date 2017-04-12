<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use SmoDav\Models\Traits\HasStatus;

class PriceList extends Model
{
    use HasStatus;

    protected $fillable = [
        'price_list_name_id', 'stock_item_id', 'unit_conversion_id', 'inclusive_price',
        'exclusive_price', 'tax'
    ];

    public function unit()
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_conversion_id');
    }
}
