<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'iso',
        'name',
        'nicename',
        'iso3',
        'numcode',
        'phonecode',
        'status'
    ];
    public function scopeApiSelection($query){
        return $query->where('status','1')->select('id','iso','nicename','phonecode');
    }
    public function address(){
        return $this->hasOne(Address::class,'country_id');
    }
}
