<?php

namespace SmoDav\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{

    protected $fillable = ['petty_cash_type_id', 'user_id', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pettyCashType()
    {
        return $this->belongsTo(PettyCashType::class, 'petty_cash_type_id');
    }
}
