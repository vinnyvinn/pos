<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'phone_number', 'email', 'account_number', 'address', 'account_balance', 'is_credit',
        'credit_limit', 'is_system', 'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->account_number = 'CST-' . str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }

    public function increaseBalance($amount)
    {
        $this->account_balance = $this->account_balance + $amount;

        return $this;
    }

    public function decreaseBalance($amount)
    {
        $this->account_balance = $this->account_balance -  $amount;

        return $this;
    }
}
