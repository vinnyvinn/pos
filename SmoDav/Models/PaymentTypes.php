<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTypes extends Model
{
    //
    protected $fillable = ['name', 'slug', 'description'];
}
