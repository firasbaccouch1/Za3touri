<?php
namespace App\Trait;

use App\Http\Resources\WishlistResource;
use App\Models\Users\User;
use App\Models\Users\Wishlist;
use Illuminate\Support\Facades\Auth;

Trait WishlistTrait{

        function createwishlist($product_id){
           $user_id = Auth::id();
           $Wishlist = Wishlist::where([['user_id',$user_id],['product_id',$product_id]])->first();
            if (!$Wishlist) {
                Wishlist::create([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
    
                ]);
                return true;
            }else{
                return false;
            }
        }

        function getwishlist(){
            $wishlist=  Auth::guard('web')->user()->whereHas('product')->with('product',function($q){
                $q->Active()
           ->with('category',function($q){
                $q->ApiSelection()->Active()->with(['discount' => function($q){
                   $q->Active()->ApiSelection();
                }]);
           })->with('discount',function($q){
                $q->Active()->ApiSelection();
       });
      })->get();
           return Api_response('success',200,WishlistResource::collection($wishlist));
        }

        function removeitem($product_id){
          $user_id = Auth::id();
          $wishlist=  Wishlist::where([['user_id',$user_id],['product_id',$product_id]])->first();
          if ($wishlist) {
            return true;
          }else{
              return false;
          }
        }
       

}