<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $fillable = ['product_id','quantity','total'];
}
