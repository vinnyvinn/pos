<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const PURCHASE_ORDER = 0;
    const INVOICE = 1;
    const GOODS_RECEIVED_VOUCHER = 2;

    const STATUS_UNPROCESSED = 0;
    const STATUS_PARTIALLY_PROCESSED = 1;
    const STATUS_PROCESSED = 2;
    const STATUS_ARCHIVED = 3;
}
