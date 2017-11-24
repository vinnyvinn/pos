<?php

namespace SmoDav\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmoDav\Models\Traits\HasStatus;

class StockItem extends Model
{
    use HasStatus, SoftDeletes;

    protected $fillable = [
        'unit_cost', 'buying_tax', 'selling_tax', 'credit_note_tax', 'code', 'barcode', 'name',
        'description', 'is_active', 'stocking_uom', 'selling_uom', 'has_conversions', 'is_serial_item',
        'is_expiry_item'
    ];

    protected static function boot()
    {
        parent::boot();

        self::created(function ($item) {
            self::createStock($item);
        });
        self::creating(function ($model) {
            $model->code = strtoupper($model->barcode);

            return $model;
        });

        self::updating(function ($model) {
            $model->code = strtoupper($model->barcode);

            return $model;
        });
    }

    private static function createStock($item)
    {
        $items = Stall::all(['id'])
            ->map(function ($stall) use ($item) {
                return [
                    'stall_id' => $stall->id,
                    'item_id' => $item->id,
                    'quantity_on_hand' => 0,
                    'quantity_reserved' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            })
            ->toArray();

        Stock::insert($items);
    }

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

    public function uom()
    {
      return $this->belongsTo(UnitOfMeasure::class, 'selling_uom', 'id');
    }

    public function stock()
    {
      return $this->hasMany(Stock::class, 'item_id');
    }

    public static function forSale($stallId)
    {
        $items = StockItem::active()->with([
            'prices' => function ($builder) {
                return $builder->select([
                  'stock_item_id', 'unit_conversion_id', 'inclusive_price'
                ]);
            },
            'stock' => function ($builder) use ($stallId) {
                  return $builder->where('stall_id', $stallId)
                      ->select(['item_id', 'quantity_on_hand']);
              },
              'conversions' => function ($builder) {
                  return $builder->select([
                     'stocking_unit_id', 'stock_item_id', 'converted_unit_id',
                    'stocking_ratio', 'converted_ratio'
                  ]);
              },
              'sellingTax' => function ($builder) {
                  return $builder->select(['id', 'rate']);
              }
            ])
            ->get([
                'id', 'code', 'description', 'has_conversions', 'name', 'selling_tax',
                'selling_uom', 'stocking_uom'
              ]);

        return $items;
    }
}
