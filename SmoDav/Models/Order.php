<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = [
        'account_id','user_id','stall_id','document_type','document_status','document_number','order_number',
        'external_order_number', 'description', 'due_date', 'order_date'
    ];
    use SoftDeletes;

    const PURCHASE_ORDER = 0;
    const INVOICE = 1;
    const GOODS_RECEIVED_VOUCHER = 2;

    const STATUS_UNPROCESSED = 0;
    const STATUS_PARTIALLY_PROCESSED = 1;
    const STATUS_PROCESSED = 2;
    const STATUS_ARCHIVED = 3;

    public function stall()
    {
        return $this->hasMany(Stall::class);
    }

    public static function boot()
    {
        self::created(function ($model) {
            $model->order_number = 'ORD-' .str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }
}
