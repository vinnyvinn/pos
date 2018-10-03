<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    protected $fillable = ['item_id','quantity','unit_price','sub_total','item_name'];
}
