<?php

namespace Database\Seeders;

use App\Models\Admin\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::Create([
            'title_en'=> 'The best pc you will find it here',
            'title_ar'=>'افضل الحواسيب تجدها هنا',
            'short_description_en'=> Str::random(60),
            'short_description_ar'=>Str::random(60),
            'photo' =>  'backend/img/sliders/pc.webp',
            'category_id'=>3,
        ]);
        Slider::Create([
            'title_en'=> 'The best phones you will find it here',
            'title_ar'=>'افضل الهواتف تجدها هنا',
            'short_description_en'=> Str::random(60),
            'short_description_ar'=>Str::random(60),
            'photo' =>  'backend/img/sliders/phone.webp',
            'category_id'=>2,
        ]);
    }
}
