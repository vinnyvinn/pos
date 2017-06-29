<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'stall_id', 'item_id', 'quantity_on_hand', 'quantity_reserved'
    ];
}
