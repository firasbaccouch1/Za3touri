<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Multi_img extends Model
{
    use HasFactory;

    protected  $fillable =[
        'id',
        'product_id',
        'images',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
   public function scopeimages($query,$id) {
    return $query->select('images')->where('product_id',$id)->get();
   }
 
  
}
