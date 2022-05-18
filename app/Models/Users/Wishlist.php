<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
    ];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
