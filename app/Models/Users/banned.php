<?php

namespace App\Models\Users;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class banned extends Model
{
    protected $table ='banneds';
    protected $fillable = [
        'user_id',
        'banned_by'      
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
