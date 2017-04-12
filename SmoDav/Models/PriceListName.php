<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use SmoDav\Models\Traits\HasStatus;

class PriceListName extends Model
{
    use HasStatus;

    protected $fillable = [
        'name', 'is_active', 'description'
    ];
}
