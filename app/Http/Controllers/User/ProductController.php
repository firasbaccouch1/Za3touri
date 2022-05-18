<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Admin\Product;
use App\Models\Users\Review;
use App\Models\Users\Wishlist;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug){
       $product = Product::where('slug',$slug)->Active()->ApiSelection()->with(['category' => function($q){
        $q->Active()->ApiSelection()->with(['discount'=> function($q){
        $q->Active()->ApiSelection();
    }]);
 }])->with(['discount' => function($q){
            $q->Active()->ApiSelection();
        }])->with('multi_img')->withCount('emailme')->first();
     $wishlistcount =   Wishlist::where('product_id',$product->id)->count();
     $review = Review::where('product_id',$product->id)->with('user')->get();
     $reviewsStar=0;
     foreach ($review as $value) {
        $reviewsStar = $reviewsStar + $value->star;
     }
     if ( $review->count() >=1) {
        $reviewsStar = $reviewsStar/ $review->count();
     }
     
    if ($product) {
        $Api = [
            'Product' => $product,
            'wishlist'=>  $wishlistcount,
            'review' => ReviewResource::collection($review),
            'review_count' => $review->count(),
            'reviewsStar' => $reviewsStar
        ];
      return Api_response('success',200,$Api);
    }
    return Api_response('somthing went wrong',404,'');

    }
}
