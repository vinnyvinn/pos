<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'name', 'login_at', 'email'
    ];  //
}
