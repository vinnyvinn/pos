<?php

namespace App;
use App\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
    public function stall()
    {
        return $this->belongsTo('SmoDav\Models\Stall','stall_id','id');
    }
}
