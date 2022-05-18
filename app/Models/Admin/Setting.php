<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable=[
        'name_en',
        'name_ar',
        'email',
        'logo_top',
        'logo_site',
        'description',
        'tags',
        'status',
        'maintenance_message',
        'maintenance_photo',

    ];
}
