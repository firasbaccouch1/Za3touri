<?php

namespace App\Models\Users;


use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'street_address',
        'first_name',
        'last_name',
        'country_id',
        'default',
        'user_id',
        'state',
        'city',
        'zipcode',
        'phone',
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function country(){
        return $this->belongsTo(Countries::class,'country_id');
    }

}
