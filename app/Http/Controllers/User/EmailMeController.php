<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Users\EmailMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailMeController extends Controller
{
    public function index($slug){
       $product= Product::where('slug',$slug)->first();
       if ($product) {
           $Emailme =EmailMe::where([['user_id',Auth::id()],['product_id',$product->id]])->first();
           if (!$Emailme) {
            EmailMe::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
               ]);
            return Api_response('We\'ll email you when the price of this product drops',200);
           }
           return Api_response('You are already on the list',419);
       }
       return Api_response('product not found',404);
    }
}
