<?php

namespace App;
use App\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $fillable = ['name','price','category_id'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
}
