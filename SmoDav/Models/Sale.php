<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
          protected $fillable = [
            'unit_conversion_id',
            'uom',
            'stock_item_id',
            'stock_name',
            'quantity',
            'unitExclPrice',
            'unitInclPrice',
            'totalInclPrice',
            'totalExclPrice',
            'total_tax'
            ];
}
