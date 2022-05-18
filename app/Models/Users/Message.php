<?php

namespace App\Models\Users;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'subject',
        'message',
    ];
    public function message(){
        return $this->belongsTo(User::class,'user_id');
    }

}
