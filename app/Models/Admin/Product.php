<?php

namespace App\Models\Admin;

use App\Models\Users\Cart;
use App\Models\Users\EmailMe;
use App\Models\Users\Review;
use App\Models\Users\User;
use App\Scopes\ProductScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected  $fillable =[
       'id',
    'name_en',
    'name_ar',
    'slug',
    'discription_en',
    'discription_ar',
    'status',
    'price',
    'thumbnail',
    'qantite',
    'category_id',
    'review_status',
    'updated_at',
    'created_at',
    'deleted_by',
    ];
    protected $hidden = [
        'created_at',
        'review_status',
        'category_id',

    ];
    public function scopeActive($query){
      return $query->where('status',1);
    }
    public function scopeApiSelection($query){
      return $query->select('id','name_en as name','slug','discription_en as discription','price','thumbnail','qantite','category_id');
    }
    public function user()
    {
        return $this->belongsToMany(User::class,'wishlists','product_id', 'user_id')->withPivot('id');
    }
    public function review(){
      return $this->hasMany(Review::class,'product_id');
    }
    public function emailme(){
      return $this->hasMany(EmailMe::class,'product_id');
  }

    public function multi_img(){
        return $this->hasMany(Multi_img::class,'product_id','id');
    }
    public function category(){
        return  $this->belongsTo(Category::class,'category_id','id')->withTrashed();
      }
    public function discount(){
        return  $this->hasOne(Discount::class,'product_id','id');
      }
    public function cart(){
        return $this->hasMany(Cart::class,'product_id');
    }  
      public function getUpdatedAtAttribute($value)
      {
          return Carbon::parse($value)->diffForHumans();
      }   
      public function scopeTrashedProducts($query){
      $product = $query->with(['category' => function($q){
          $q->select('id','name_en');
      }])->select('id','name_en as name','thumbnail as photo','deleted_by','deleted_at','category_id')->onlyTrashed()->get();
       foreach ($product as $data ) {
        $data->type = 'product';
        $data->category = $data->category->name_en;

      }
      return $product->toArray();
    }
    protected  static function boot(){
      parent::boot();
      static::deleting(function ($product){
      if ($product->isForceDeleting()) {
        if ($product->multi_img != null) {
          $product->multi_img->each(function($multi_img){
            unlink($multi_img->images);
          });
        }
        unlink($product->thumbnail);
      }else{
        if ($product->discount != null) {
          $product->discount->each(function($discount){
            $discount->delete();
          });
        }
      }
      });
      static::addGlobalScope(new ProductScope);
    }

  



}
