<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'phone_number', 'email', 'account_number', 'address', 'account_balance', 'is_active'
    ];
}
