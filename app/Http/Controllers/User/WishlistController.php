<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Users\Wishlist;
use App\Trait\WishlistTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use WishlistTrait;

    public function index(){
      return  $this->getwishlist();
    }



    public function Create($slug){
        $product= Product::where('slug',$slug)->first();
        if ($product) {
           if ($this->createwishlist($product->id)) {
              return Api_response('Product Added Successfully To Wish List',200,'');
           }else{
            return Api_response('Product Already Exists in WishList',419,''); 
           }
           return Api_response('Somthing Went Wrong Try Again Later',419,''); 
        }
    }
    public function remove($slug){
        $product = Product::where('slug',$slug)->first();
        if ($product) {
            if ($this->removeitem($product->id)) {
                $product->delete();
                return Api_response('Wishlist Deleted Successfully',200,'');
            }
        }
        return Api_response('Somthing Went Worng try Again Later',419,'');
    }

    public function DeleteAll(){
        $user_id = Auth::id();
       $wishlist=  Wishlist::where('user_id',$user_id)->get();
       if($wishlist){
           foreach ($wishlist as $value) {
               $value->delete();
           }
           return Api_response('Wishlist Cleared Successfully',200,'');
       }
       Api_response('Somthing Went Worng try Again Later',419,'');
    }

}
