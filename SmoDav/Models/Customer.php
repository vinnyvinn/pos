<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone_number', 'email', 'account_number', 'address'];
}
