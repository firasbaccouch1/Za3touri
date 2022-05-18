<?php

namespace App\Models\Users;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    protected $hidden =[
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->hasOne(User::class,'user_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
