<?php
namespace App\Trait;

use App\Http\Resources\CartResource;
use App\Models\Admin\GeneralSettings;
use App\Models\Users\Cart;
use Illuminate\Support\Facades\Auth;

Trait CartTrait{

    function CreateCart($product_id,$quantity = 1){
       $user_id = Auth::id();
       $cart = Cart::where([['user_id',$user_id],['product_id',$product_id]])->first();
       if (!$cart) {
        Cart::Create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
        return true;
       }
       return false;

    }

    function getCart(){
            $user_id = Auth::id();
            $cart =   Cart::where('user_id',$user_id)->with('product',function($q){
                    $q->Active()->ApiSelection()
                ->with('discount',function($q){
                        $q->Active()->ApiSelection();
                })
                ->with('category',function($q){
                     $q->ApiSelection()->Active()
                     ->with('discount',function($q){
                        $q->Active()->ApiSelection();
                });
                });
           })->get();
           $Subtotal = 0;
           $newCart = CartResource::collection($cart->where('product','!=',null))->response()->getData();
           foreach ($newCart as  $value ) {
               if($value->product->discount != null){
                $Subtotal = $Subtotal + ( $value->product->price - ($value->product->price * $value->product->discount->discount / 100 )) * $value->quantity;
               }else{
                $Subtotal = $Subtotal + $value->product->price * $value->quantity;
               }
           }
            $general_setting= GeneralSettings::first();
            $Total = $Subtotal + round((($Subtotal*$general_setting->tax)/100)) + $general_setting->shipping ;
         return [
             'Sub_Total' =>$Subtotal,
             'Total'    =>$Total,
             'Cart_Data'  => $newCart,
             'count'  => count($newCart),
             'Tax'   => $general_setting->tax,
             'Shipping' => $general_setting->shipping,
            ];
        }

    
    function UpdateCart($product_id,$quantity){
        $user_id = Auth::id();
        Cart::where([['user_id',$user_id],['product_id',$product_id]])->update([
            'quantity' => $quantity,
        ]);
        return Api_response('updated Successfully',200,'');
    }
    function DeleteCart($product_id){
        $cart = Cart::where([['user_id',Auth::id()],['product_id',$product_id]])->first();
        if ($cart) {
            $cart->delete();
            return Api_response('Deleted Successfully',200,'');
        }
        return Api_response('Somthing went wrong',404,'');
    }
    public function DeleteAllCartData(){
        $user_id = Auth::id();
       $cart = Cart::where('user_id',$user_id)->get();
        if ($cart) {
            foreach ($cart as $value) {
                $value->delete();
            }
        }
    }

}