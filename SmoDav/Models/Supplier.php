<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'phone_number', 'email', 'account_number', 'address', 'account_balance', 'is_active', 'credit_limit',
        'is_credit','is_system'
    ];

    /**
     *
     */
    protected static function boot()
    {
        self::created( function ($model) {
            $model->account_number = 'SUP-' .str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }
}
