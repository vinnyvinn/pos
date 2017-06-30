<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'phone_number', 'email', 'account_number', 'address', 'account_balance', 'is_active'
    ];
}
