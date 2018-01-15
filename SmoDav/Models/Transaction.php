<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['type', 'amount', 'transactionable_id', 'transactionable_type'];
}