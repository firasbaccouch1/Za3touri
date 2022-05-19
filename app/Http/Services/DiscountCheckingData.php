<?php
namespace App\Http\Services;

use App\Models\Admin\Category;
use App\Models\Admin\Discount;
use App\Models\Admin\Product;

class DiscountCheckingData{

    function CheckingDiscount($request){
        if ($request->has('product')) {
            //checking if product or the category of product has discount if yes return false
        $product = Product::where('id',$request->product)->whereDoesntHave('discount')->first();
        $category = Product::where('id',$request->product)->with(['category' => function($q){
        $q->whereDoesntHave('discount');
       }])->first();
       if($category->category == null || !$product){
           return false;
       }else{
           return true;
       }
        //checking if category has product discounted if yes return false    
        }else{
            $category = Category::where('id',$request->category)->whereDoesntHave('discount')->first();
            $product = Product::where('category_id',$request->category)->whereHas('discount')->first();
            if($product || !$category){
                return false;
            }else{
                return true;
            }
        }

    }
}