<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Admin\Product;
use App\Models\Users\Review;
use App\Trait\ReviewsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    use ReviewsTrait;
    public function create(ReviewRequest $request){
        $user_id = Auth::id();
        $product_id = Product::where('slug',$request->slug)->first()->id;
        if ($product_id) {
          $review=  Review::where([['product_id',$product_id],['user_id',$user_id]])->first();
            if (!$review) {
                if ($this->CreateReview($product_id,$request)) {
                    $data= $this->ProductReview($product_id);
                    return Api_response('Review added successfully',200,$data);
                 }else{
                    return Api_response('you only can make Review to order that you try it',419,'');
                 }
            }else{
                return Api_response('you already review this product',419,'');
            }
        }
        return Api_response('Product not Found',404,'');
    }
    public function delete($slug){
        $user_id = Auth::id();
        $product_id = Product::where('slug',$slug)->first()->id;
        $review =Review::where([['user_id',$user_id],['product_id',$product_id]])->first();
        if ($review) {
            $review->delete();
        $data =  $this->ProductReview($product_id);
            return Api_response('Review deleted successfully',200,$data);

        }else{
            return Api_response('somthing went wrong please try again later',404);
        }
    }
}
