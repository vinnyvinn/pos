<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = [
        'account_id','user_id','stall_id','document_type','document_status','document_number','order_number',
        'external_order_number', 'description', 'due_date', 'order_date','total_exclusive' ,'total_inclusive',
        'total_tax'
    ];
    use SoftDeletes;

    const PURCHASE_ORDER = 0;
    const INVOICE = 1;
    const GOODS_RECEIVED_VOUCHER = 2;

    const STATUS_UNPROCESSED = 0;
    const STATUS_PARTIALLY_PROCESSED = 1;
    const STATUS_ARCHIVED = 2;

    public static function boot()
    {
        self::created(function ($model) {
            $model->document_number = 'DOC-' .str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }

    public function scopeUnprocessed($builder)
    {
        return $builder->where('document_status', self::STATUS_UNPROCESSED);
    }

    public function scopePartial($builder)
    {
        return $builder->where('document_status', self::STATUS_PARTIALLY_PROCESSED);
    }

    public function scopeArchived($builder)
    {
        return $builder->where('document_status', self::STATUS_ARCHIVED);
    }

    public function scopePurchase($builder)
    {
        return $builder->where('document_type', self::PURCHASE_ORDER);
    }

    public function scopeInvoice($builder)
    {
        return $builder->where('document_type', self::INVOICE);
    }

    public function scopeReceived($builder)
    {
        return $builder->where('document_type', self::GOODS_RECEIVED_VOUCHER);
    }

    public function stall()
    {
        return $this->belongsTo(Stall::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'account_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'account_id');
    }
}
