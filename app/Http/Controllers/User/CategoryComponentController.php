<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class CategoryComponentController extends Controller
{
   public function index(Request $request ,$slug){
      $category =  Category::where('slug',$slug)->Active()->ApiSelection()->first();
      $product = Product::with(['discount'=> function($q){
         $q->Active()->ApiSelection();
     }])->where('category_id',$category->id)->Active()->ApiSelection()->
      with(['category'=>function($q){
         $q->with('discount',function($q){
            $q->Active()->ApiSelection();
         });
      }])->get();
        if($category->count() > 0){
            $api= [
               'category' =>$category,
               'product' => ProductResource::collection($product)->response()->getData(),
            ];
            return Api_response('success',200,$api);
        }
        
        return response()->json('somthing went wrong',500);
   }
}
