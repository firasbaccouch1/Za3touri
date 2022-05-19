<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FilterRequest;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class FilterProductsComponentController extends Controller
{
 public function index(){
     $product = Product::with(['discount'=> function($q){
        $q->Active()->ApiSelection();
    }])->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->with('review')->Active()->ApiSelection()->paginate(10);
     $category = Category::where('active',1)->ApiSelection()->get();
     $api=[
         'product' => ProductResource::collection($product)->response()->getData(),
         'category' => $category,
     ];
    return Api_response('success',200,$api);
     
 }
 public function Filter($number,$show,$category){
    $numbers = [25,10,15,50];

    $Categoryid = Category::where('id',$category)->first();
    if (!$Categoryid) {
    if (in_array($number,$numbers)) {
         if ($show =='Newest') {
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->with('review')->Active()->ApiSelection()->orderBy('id', 'DESC')->paginate($number);
     }
    if($show == 'Latest'){
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->with('review')->Active()->ApiSelection()->latest()->paginate($number);
     }
    
    if($show == 'LowestPrice'){
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->with('review')->Active()->ApiSelection()->orderBy('price', 'ASC')->paginate($number);
    }
    if($show == 'HighestPrice'){
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->with('review')->Active()->ApiSelection()->orderBy('price', 'DESC')->paginate($number);
     }
     $Api=[
         'product' => ProductResource::collection($product)->response()->getData(),
 
     ];
     return Api_response('success',200,$Api);
     }
 }if ($Categoryid) {
     if (in_array($number,$numbers)) {
         if ($show =='Newest') {
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->where('category_id',$Categoryid->id)->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->Active()->ApiSelection()->orderBy('id', 'DESC')->paginate($number);
     }
    if($show == 'Latest'){
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->where('category_id',$Categoryid->id)->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->Active()->ApiSelection()->latest()->paginate($number);
     }
    
    if($show == 'LowestPrice'){
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->where('category_id',$Categoryid->id)->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->Active()->ApiSelection()->orderBy('price', 'ASC')->paginate($number);
    }
    if($show == 'HighestPrice'){
         $product = Product::with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }])->where('category_id',$Categoryid->id)->with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->Active()->ApiSelection()->orderBy('price', 'DESC')->paginate($number);
     }
     $Api=[
         'product' => ProductResource::collection($product)->response()->getData(),
 
     ];
     return Api_response('success',200,$Api);
     }
 }
 
     return Api_response('error',404,'');
 }

}
