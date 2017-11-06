<?php

namespace SmoDav\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{

    protected $fillable = ['petty_cash_type_id', 'user_id', 'amount'];

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function pettyCashType()
    {
        return $this->hasOne(PettyCashType::class, 'id', 'petty_cash_type_id');
    }
}
