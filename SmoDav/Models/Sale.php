<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
          protected $fillable = [
            'stock_item_id',
            'stall_id',
            'sale_id',
            'stock_name',
            'code',
            'description',
            'quantity',
            'tax_rate',
            'unit_tax',
            'discount',
            'unitExclPrice',
            'unitInclPrice',
            'totalInclPrice',
            'totalExclPrice',
            'total_tax',
              'discount'
            ];
  public function stock()
  {
    return $this->belongsTo(StockItem::class, 'stock_item_id' , 'id');
  }
}
