<?php

namespace App\Models\Users;


use Illuminate\Database\Eloquent\Model;

class EmailResets extends Model
{
    protected $table = 'email_resets';
    protected $fillable = [
        'user_id',
        'token',
        'active',
        'created_at'   
    ];
    public $timestamps = false;

    public function user(){
        return $this->hasMany(User::class,'user_id');
    }
}
