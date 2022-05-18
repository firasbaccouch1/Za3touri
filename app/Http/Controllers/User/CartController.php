<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Users\Cart;
use App\Trait\CartTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
use CartTrait;

    public function index(){
        $Api= [
            'Cart' =>  $this->getCart(),
        ];
        return Api_response('success',200,$Api);
    }
    
    public function create($slug){
       $product = Product::where('slug',$slug)->first();
        if ($product) {
        if ($this->CreateCart($product->id)) {
            return  Api_response('Product Successfully Added in Your Cart',200,$this->getCart());
        }
        return Api_response('Product Already Exist in Cart',419,$this->getCart());
        }      
    }

     
    
    public function remove($slug){
        $product = Product::where('slug',$slug)->first();
        if ($product) {
        $this->DeleteCart($product->id);
        return  Api_response('Product Successfully removed From Your Cart',200,$this->getCart());    
        }
    }

    public function update(Request $request){
        
        foreach ($request->data as $cart) {
           $this->UpdateCart($cart['product'],$cart['quantity']);
        }
        return Api_response('Cart Updated Successfully',200,$this->getCart());

    }
    public function DeleteAll(){
            $this->DeleteAllCartData();
        $Api =[
            'Cart' => [   'Total' => 0,
            'Cart_Data'  => [],
            'count'  => 0,
            ]
        ];
        return Api_response('Cart is Clear',200,$Api);

    }
    public function createWithquantity($slug,$quantity){
        
        if (!(in_array((int)$quantity, range(1, 10), true))) {
            return Api_response('The Quantity that you give is not between 10 and 1',419,'');
        } 
        $product = Product::where('slug',$slug)->first();
         if ($product) {
         if ($this->CreateCart($product->id,$quantity)) {
             return  Api_response('Product Successfully Added in Your Cart',200,$this->getCart());
         }
         return Api_response('Product Already Exist in Cart',419,$this->getCart());
         }      
     }

}
