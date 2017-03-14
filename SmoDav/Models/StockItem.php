<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $fillable = [
        'unit_cost', 'buying_tax', 'selling_tax', 'credit_note_tax', 'code', 'barcode', 'name', 'description'
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
}
