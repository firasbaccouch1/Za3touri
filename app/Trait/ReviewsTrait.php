<?php
namespace App\Trait;

use App\Http\Resources\ReviewResource;
use App\Models\Users\Orders;
use App\Models\Users\Review;
use Illuminate\Support\Facades\Auth;

Trait ReviewsTrait{

    function getReviews($product_id){
      $reviews=  Review::where('product_id',$product_id)->with(['user' => function($q){
        $q->select('id','name');
      }])->get();
      return $reviews;
    }
    function CreateReview($product_id,$request){
        $user_id =Auth::id();
   $orders =   Orders::where([['user_id',$user_id],['status','delivered']])->get();
   $productdelevred = false;
     foreach ($orders as  $order) {
         foreach($order->data['purchases']['Cart_Data'] as $cart){
            if ($cart['product_id'] == $product_id) {
             $productdelevred = true;
            }
         }
     }
        if ($productdelevred) { 
            Review::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'star' => $request->star,
            'comment' => $request->comment,
        ]);
        return true;
        }else{
        return false;
        }
    }

     function ProductReview($product_id){
      $review = Review::where('product_id',$product_id)->with('user')->get();
      $reviewsStar=0;
      foreach ($review as $value) {
         $reviewsStar = $reviewsStar + $value->star;
      }
      if ( $review->count() >=1) {
         $reviewsStar = $reviewsStar/ $review->count();
    }
   return $Api=[
      'review' => ReviewResource::collection($review),
      'review_count' => $review->count(),
      'reviewsStar' => $reviewsStar
    ];
  }

}