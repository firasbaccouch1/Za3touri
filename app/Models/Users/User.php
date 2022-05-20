<?php

namespace App\Models\Users;

use App\Mail\ResetEmail;
use App\Models\Admin\Product;
use App\Models\Users\banned;
use App\Models\Users\Review;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable 
{
   use  Notifiable,HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birthday',
        'photo',
        'phone',
        'ip_address',

        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'photo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getBirthdayAttribute($value)
    {
        if ($value != null) {
            return Carbon::parse($value)->format('Y-m-d');
        }

    } 
    
    public function cart(){
        return $this->hasMany(Cart::class,'user_id','id');
    }
    public function emailreset(){
        return $this->belongsTo(ResetEmail::class,'user_id');
    }
    public function emailme(){
        return $this->hasOne(EmailMe::class,'user_id');
    }
    
    public function review(){
        return $this->hasMany(Review::class,'user_id');
    }
    
    public function product()
    {
        return $this->belongsToMany(Product::class,'wishlists','user_id', 'product_id')->withPivot('id');
    }
    public function address(){
        return $this->hasMany(Address::class,'user_id');
    }
    public function order(){
        return $this->hasMany(Orders::class,'user_id');
    }
    public function wishlist(){
        return $this->hasMany(Wishlist::class,'user_id');
    }
    public function banned(){
        return $this->hasOne(banned::class,'user_id');
    }
    public function feedback(){
        return $this->hasOne(Feedback::class,'user_id');
    }

}
