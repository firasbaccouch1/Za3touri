<?php
namespace App\Trait;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Builder;

Trait EmailMeTrait{

  function preparingEmailData($slug,$oldprice=0){
    $productdiscount = Product::where('slug',$slug)
    ->with(['discount'=>function($q){
     $q->ApiSelection()->Active();
 }])->with('category' , function($q){
     $q->ApiSelection()->Active()->with(['discount'=> function($q){
     $q->Active();
     }]);
 })->Apiselection()->Active()->with(['emailme'=>function($q){
     $q->with('user');
 }])->first();
 if ($productdiscount->category->discount != null || $productdiscount->discount != null || $oldprice > $productdiscount->price ) {
     $data= [
         'name' => $productdiscount->name?$productdiscount->name:$productdiscount->name_en,
         'slug' => $productdiscount->slug,
         'discription' => $productdiscount->discription?$productdiscount->discription:$productdiscount->discription_en,
         'price' => $productdiscount->price,
         'oldprice' => $oldprice=0?null:$oldprice,
         'thumbnail' => $productdiscount->thumbnail,
         'discount' => $this->prepearingDiscountData($productdiscount,$oldprice),
         'category' => [
             "name"=>$productdiscount->category->name,
             "slug"=>$productdiscount->category->slug,
            "icon"=>$productdiscount->category->icon,
         ], 
         'users' => [],
        ];
        foreach ($productdiscount->emailme as  $value) {
           array_push($data['users'],[
                   'first_name'  => $value->user->first_name,
                   'last_name'  => $value->user->last_name, 
                   'email' => $value->user->email,
                   ]);
        }
      return $data;  
      }  
      return null;
  }

    function prepearingDiscountData($productdiscount,$oldprice){
      if ($oldprice == 0) {
        if ($productdiscount->discount != null) {
          return $productdiscount->discount->discount;
         }
         if ($productdiscount->category->discount != null) {
           return $productdiscount->category->discount->discount;
         }
      }else{
        return null;
      }
    }

}