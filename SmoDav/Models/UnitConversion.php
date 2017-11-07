<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    protected $fillable = [
        'stock_item_id', 'stocking_unit_id', 'converted_unit_id', 'converted_ratio', 'stocking_ratio'
    ];

    public function unit()
    {
        return $this->belongsTo(UnitOfMeasure::class, 'converted_unit_id');
    }
}
