<?php

namespace App\Models\Admin;

use Carbon\Carbon;
use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable 
{
   use HasRoles;
   use Notifiable;
   
     


    protected $fillable = [
        'name',
        'email',
        'password',
        'images',
        'roles_name',
        'photo',
        
    ];


    protected $hidden = [
        'password',
    
    ];
    protected $casts = [
        'roles_name' => 'array',
    ];
        
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
 

}
