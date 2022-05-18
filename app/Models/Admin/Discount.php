<?php

namespace App\Models\Admin;

use App\Scopes\DiscountScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'product_id',
        'status',
        'counter',
        'category_id',
        'expired_at',
        'updated_at',
        'created_at',
        'deleted_by',
    ];
    public function scopeActive($query)
    {
     return $query->where('status',1);
    }
    public function scopeApiSelection($query)
    {
     return $query->select('id','discount','product_id','category_id','expired_at');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
      public function getExpiredAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    protected static function boot()
    {
        parent::boot();
  
        static::addGlobalScope(new DiscountScope);
    }
   

}
