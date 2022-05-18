<?php

namespace Database\Seeders;

use App\Models\Admin\Multi_img;
use App\Models\Admin\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <30;  $i++) { 
          $id=  Product::insertGetId([
                'name_en' => 'Product '.$i,
                'name_ar' => 'مونتج'.$i,
                'slug' => strtolower(str_replace(' ','_','Product '.$i,)),
                'discription_en' => Str::random(60),
                'discription_ar'=> Str::random(60),
                'price' =>  random_int(400,1000),
                'thumbnail' => 'backend/img/Product/thamnaile/pc.webp',
                'qantite' => random_int(30,60),
                'category_id' => 2,
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/pc1.webp',
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/pc2.webp',
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/pc3.webp',
            ]);
        }
        for ($i=30;   $i <60  ; $i++) { 
            $id=  Product::insertGetId([
                'name_en' => 'Product '.$i,
                'name_ar' => 'مونتج'.$i,
                'slug' => strtolower(str_replace(' ','_','Product '.$i,)),
                'discription_en' => Str::random(60),
                'discription_ar'=> Str::random(60),
                'price' => random_int(350,700),
                'thumbnail' => 'backend/img/Product/thamnaile/laptop.webp',
                'qantite' => 60,
                'category_id' => 3,
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/laptop1.webp',
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/laptop2.webp',
            ]);
        }
        for ($i=60;  $i <90 ; $i++) { 
            $id=  Product::insertGetId([
                'name_en' => 'Product '.$i,
                'name_ar' => 'مونتج'.$i,
                'slug' => strtolower(str_replace(' ','_','Product '.$i,)),
                'discription_en' => Str::random(60),
                'discription_ar'=> Str::random(60),
                'price' => random_int(600,1200),
                'thumbnail' => 'backend/img/Product/thamnaile/phone.webp',
                'qantite' => 60,
                'category_id' => 1,
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/phone1.webp',
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/phone2.webp',
            ]);
            Multi_img::create([
                'product_id' => $id,
                'images' => 'backend/img/Product/images/phone3.webp',
            ]);
        }
        for ($i=90; $i <=120; $i++) { 
            $id=  Product::insertGetId([
                'name_en' => 'Product '.$i,
                'name_ar' => 'مونتج'.$i,
                'slug' => strtolower(str_replace(' ','_','Product '.$i,)),
                'discription_en' => Str::random(60),
                'discription_ar'=> Str::random(60),
                'price' => random_int(200,500),
                'thumbnail' => 'backend/img/Product/thamnaile/tv.webp',
                'qantite' => 60,
                'category_id' => 4,
            ]);
        }

    }
}
