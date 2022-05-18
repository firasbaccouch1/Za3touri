<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use SoftDeletes;
    

    
    protected $fillable = [
      'id',
        'name_en',
        'name_ar',
        'slug',
        'icon',
        'active',
        'created_at',
        'updated_at',
        'deleted_by',
        
    ];

    protected $hidden = ['created_at'];
    public function scopeActive($query){
      return $query->where('active',1);
  }
  public function scopeApiSelection($query){
    return $query->select('id','name_en as name','slug','icon');
}

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
    public function slider(){
  return  $this->hasOne(Slider::class,'category_id','id')->withTrashed();
    }

    public function scopeCategoryname($query){
        return $query->select('id','name_en as name','slug');
    }
    public function product(){
        return  $this->hasMany(Product::class,'category_id','id')->withTrashed();
          }
    public function discount(){
            return  $this->hasOne(Discount::class,'category_id','id');
              }
    public function scopeTrashedCategories($query){
    $categories = $query->select('id','name_en as name','icon as photo','deleted_by','deleted_at')->onlyTrashed()->get();
    foreach ($categories as $data) {
      $data->type = 'category';
    }
    return $categories->toArray();
  }
  protected  static function boot(){
    parent::boot();
    

    static::deleting(function ($categories){
      if ($categories->isForceDeleting()) {
                if ($categories->product != null) {
                  $categories->product->each(function($product){
                    $product->forceDelete();
                  });
                }
               if ($categories->discount != null) {
                   $categories->discount->each(function($discount){
                     $discount->forceDelete();
                   });
                 }
               if ($categories->slider != null) {
                $categories->slider->each(function($slider){
                    $slider->forceDelete();
                });
               }
       // end if        
      }else{
                if ($categories->product != null) {
                  $categories->product->each(function($product){
                    $product->update([
                        'deleted_by' => Auth::guard('admin')->user()->name,

                    ]);
                    $product->delete();
                  });
                }
                if ($categories->discount != null) {
                    $categories->discount->each(function($discount){
                      $discount->update([
                        'deleted_by' => Auth::guard('admin')->user()->name,

                    ]);
                      $discount->delete();
                      });
                    }
                  if ($categories->slider != null) {
                    $categories->slider->each(function($slider){
                      $slider->update([
                        'deleted_by' => Auth::guard('admin')->user()->name,
                        
                    ]);
                      $slider->delete();
                      
                    });   
                  }
          
          }//end else
      });


  }
   
}