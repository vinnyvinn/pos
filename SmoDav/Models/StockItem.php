<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmoDav\Models\Traits\HasStatus;

class StockItem extends Model
{
    use HasStatus, SoftDeletes;

    protected $fillable = [
        'unit_cost', 'buying_tax', 'selling_tax', 'credit_note_tax', 'code', 'barcode', 'name',
        'description', 'is_active', 'stocking_uom', 'selling_uom', 'has_conversions'
    ];

    public function buyingTax()
    {
        return $this->belongsTo(Tax::class, 'buying_tax');
    }

    public function sellingTax()
    {
        return $this->belongsTo(Tax::class, 'selling_tax');
    }

    public function creditNoteTax()
    {
        return $this->belongsTo(Tax::class, 'credit_note_tax');
    }

    public function conversions()
    {
        return $this->hasMany(UnitConversion::class, 'stock_item_id');
    }

    public function prices()
    {
        return $this->hasMany(PriceList::class, 'stock_item_id');
    }
}
