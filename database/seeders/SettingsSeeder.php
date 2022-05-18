<?php

namespace Database\Seeders;

use App\Models\Admin\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Setting::create([
            'name_en' => 'Za3touri', 
            'name_ar' => 'زعتوري', 
            'email' => 'firasbaccouch5@gmail.com',
            'logo_top' => 'backend/img/settings/logo_top/logo_top.webp',
            'logo_site'=>'backend/img/settings/logo_site/logo_site.webp',
            'description' =>'E-commerce site Developed by by Firas Aka Za3touri',
            'maintenance_message' => 'This Site Under Development We Will Opening Soon',
            'maintenance_photo' => 'backend/img/settings/maintenance/maintenance_photo.webp',
            'status' => 1
            ]);
    }
}
