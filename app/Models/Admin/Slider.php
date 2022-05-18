<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title_en',
        'title_ar',
        'short_description_en',
        'short_description_ar',
        'photo',
        'active',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_by',
 

    
        
    ];

    protected $hidden = ['created_at'];
    public function scopeActive($query){
        return $query->where('active',1);
     }
     public function scopeApiSelection($query){
        return $query->select('title_en as title','short_description_en as short_description','photo','category_id');
     }
    
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function category(){
      return  $this->belongsTo(Category::class,'category_id','id')->withTrashed();
    }
    public function scopeTrashedSliders($query){
       $sliders= $query->with(['category' => function($q){
        $q->select('id','name_en');
    }])->select('id','title_en as name','photo','deleted_by','deleted_at','category_id')->onlyTrashed()->get();
        foreach ($sliders as $data) {
            $data->type = 'slider';
          }
          return $sliders->toArray();
    }
    protected  static function boot(){
        parent::boot();
        static::deleting(function ($slider){
        if ($slider->isForceDeleting()) {
                unlink($slider->photo);
        }
        });
    }
  
}
