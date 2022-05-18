<?php

namespace App\Models\Users;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'payment_id',
        'order_number',
        'status',
        'updated_by',
        'comment',
        'invoice_id',
        'payment_url',
        'data',
        'updated_at',
        'created_at',
    ];
    protected $casts = [
        'data' => 'array',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function setUpdatedAtAttribute($value)
{
    $this->attributes['updated_at'] =  Carbon::parse($value)->format('Y-m-d H:i:s');
}

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function payment(){
        return $this->hasOne(Payment::class,'order_id');
    }
}
