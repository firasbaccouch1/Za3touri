<?php

namespace App\Models\Admin;

use App\Scopes\CouponScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'code',
        'discount',
        'status',
        'expiry_date',
    ];
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
    public function getExpiryDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    protected static function boot()
    {
        parent::boot();
  
        static::addGlobalScope(new CouponScope);
    }
    
}
