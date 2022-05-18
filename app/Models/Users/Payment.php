<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_gateway',
        'payment_amout',
        'payment_date',
        'payment_id',
        'paid_currency',
        'id_address',
        'country',
        'card_number'
    ];

    public function order(){
        return $this->belongsTo(Orders::class,'order_id');
    }
}
