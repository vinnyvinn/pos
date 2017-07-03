<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLine extends Model
{
    protected $fillable = [
        'order_id', 'stock_item_id', 'stall_id', 'code', 'name', 'description',
        'uom', 'order_quantity'
    ];

    public function order()
    {
        return $this->hasMany(Order::class)->order_id;
    }
//    use SoftDeletes;

}
