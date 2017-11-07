<?php

namespace SmoDav\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SmoDav\Models\Traits\HasStatus;

class UnitOfMeasure extends Model
{
    use HasStatus, SoftDeletes;

    protected $fillable = ['description', 'name', 'is_active'];
}
