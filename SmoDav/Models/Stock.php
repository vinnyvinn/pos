<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'stall_id', 'item_id', 'quantity_on_hand', 'quantity_reserved', 'external_order'
    ];

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }
}
