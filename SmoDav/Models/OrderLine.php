<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLine extends Model
{
    protected $fillable = [
        'order_id', 'stock_item_id', 'stall_id', 'code', 'name', 'description', 'uom', 'order_quantity',
        'processed_quantity', 'tax_id', 'tax_rate', 'unit_tax', 'unit_exclusive', 'unit_inclusive', 'discount',
        'total_exclusive', 'total_inclusive'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
