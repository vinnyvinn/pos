<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmoDav\Models\Traits\HasStatus;

class Supplier extends Model
{
    use HasStatus, SoftDeletes;

    protected $fillable = [
        'name', 'phone_number', 'email', 'account_number', 'address', 'account_balance', 'is_active', 'credit_limit',
        'is_credit', 'is_system'
    ];

    protected static function boot()
    {
        self::created(function ($model) {
            $model->account_number = 'SUP-' .str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }
}
