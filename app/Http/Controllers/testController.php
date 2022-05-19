<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\EmailMeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\testresource;
use App\Http\Resources\WishlistResource;
use App\Http\Services\PaymentServices;
use App\Mail\ResetEmail;
use App\Models\Admin\Category;
use App\Models\Admin\Coupon;
use App\Models\Admin\Discount;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use App\Models\Users\Cart;
use App\Models\Users\EmailResets;
use App\Models\Users\Feedback;
use App\Models\Users\Message;
use App\Models\Users\Orders;
use App\Models\Users\User;
use App\Trait\CartTrait;
use App\Trait\EmailMeTrait;
use App\Trait\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class testController extends Controller
{
    use OrderTrait;
    use CartTrait;
    private $PaymentServices;
    public function __construct(PaymentServices $PaymentServices)
    {
        $this->PaymentServices = $PaymentServices;
    }
    public function test(){ 

      
    

    }
       
}
