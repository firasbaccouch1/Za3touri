<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($name){
        $product = Product::query()
        ->where('name_en','LIKE','%'.$name.'%')
        ->orWhere('slug','LIKE','%'.$name.'%')->
        with(['category' => function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection();
        }]);
     }])->with('review')->Active()->ApiSelection()->
     with(['discount' => function($q){
        $q->Active();
    }])->paginate(10);
     $api=ProductResource::collection($product)->response()->getData();
    return Api_response('success',200,$api);
    }
}
