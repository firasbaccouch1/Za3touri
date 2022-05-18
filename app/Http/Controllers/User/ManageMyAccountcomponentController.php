<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Users\Address;
use App\Models\Users\Orders;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageMyAccountcomponentController extends Controller
{
   public function index(){
    try {
        $user_id = Auth::id();
        $orders = Orders::where('user_id',$user_id)->where('status','!=','cancel')->latest()->take(5)->get();
        $user = Auth::user();
        $address = Address::where([['user_id',$user_id],['default',1]])->with('country')->first();
        $defultaddress= null;
        $phonenumber = null;
        if ($address) {
            $defultaddress = $address->country->nicename .' '.$address->state .' '.$address->city.' '.$address->street_address;
            $phonenumber = ('+'.$address->country->phonecode).' '.$address->phone;
        }
 
        $filtedOrders= OrderResource::collection($orders);
            $Api=[
                'user' => [
                    'email' => $user->email,
                    'name' => $user->first_name . ' ' . $user->last_name,
                ],
                'address' =>[
                    'defulataddress' => $defultaddress,
                    'phone' => $phonenumber,
                    ],
                'orders' => $filtedOrders,
            ]; 
        return Api_response('success',200,$Api);
    } catch (\Throwable $th) {
        return Api_response('somthing went wrong please try agani later',404,null);
    }

  }
   
}
