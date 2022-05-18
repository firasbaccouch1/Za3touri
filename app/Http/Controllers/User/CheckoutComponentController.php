<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Users\Address;
use App\Models\Users\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutComponentController extends Controller
{
    public function index(){
        $user_id = Auth::id();
       $address =  Address::where([['user_id',$user_id],['default',1]])->with('country')->first();
       $countries =  Countries::ApiSelection()->get();
        if ($address) {
            $Api=[
                'countries' => $countries,
                'addressbook'   => $address,
             ];
        }else{
            $Api=[
                'countries' => $countries,
                'addressbook'   => null,
             ];
        }
     return Api_response('success',200,$Api);
    }
}
