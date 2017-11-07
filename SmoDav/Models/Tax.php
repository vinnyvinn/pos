<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use SmoDav\Models\Traits\HasStatus;

class Tax extends Model
{
    use HasStatus;

    protected $fillable = [
        'code', 'description', 'rate', 'is_active'
    ];

}
