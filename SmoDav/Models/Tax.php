<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'code', 'description', 'rate', 'is_active'
    ];
}
