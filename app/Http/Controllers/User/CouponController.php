<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index($coupon){
     $activecoupon =   Coupon::where([['code',$coupon],['status',1]])->first();
     if ($activecoupon) {
         return Api_response('Coupon Apply Successfully',200,$activecoupon);
     }else{
         return Api_response('Coupon is invalid',404);
     }
    }
}
