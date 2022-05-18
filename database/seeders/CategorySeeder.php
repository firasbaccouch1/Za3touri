<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Category::create([
            'name_en' => 'SMART PHONE',
            'name_ar' =>  'هاتف ذكي',
            'slug'    => 'smart_phone',
            'icon'    =>  'fas fa-mobile-alt',
       ]);
       Category::create([
        'name_en' => 'PC GAMER',
        'name_ar' =>  'كمبيوتر الألعاب',
        'slug'    => 'pc_gamer',
        'icon'    =>  'fas fa-desktop',
   ]);
     Category::create([
        'name_en' => 'LAPTOP',
        'name_ar' =>  'حاسوب محمول',
        'slug'    => 'laptop',
        'icon'    =>  'fas fa-laptop',
    ]);
    Category::create([
        'name_en' => 'TV',
        'name_ar' =>  'تلفاز',
        'slug'    => 'tv',
        'icon'    =>  'fas fa-tv',
    ]);
        }
}
