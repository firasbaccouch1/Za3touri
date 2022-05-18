<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = [
        'user_id',
        'message',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
