<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use App\Models\Users\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeComponentController extends Controller
{
    public function index(){
        $productdiscount = Product::whereHas('discount',function (Builder $query) {
            $query->where('counter',1)->active();
        })->with('review')->with(['discount'=>function($q){
            $q->ApiSelection()->Active();
        }])->with('review')->with('category' , function($q){
            $q->ApiSelection()->Active();
        })->Apiselection()->Active()->get();
        $slider = Slider::whereHas('category',function($q){
              $q->where('active',1);
        })->with(['category' => function($q){
           $q->ApiSelection();  
        }])->Active()->ApiSelection()->get();
        $allProduct = Product::with(['category'=>function($q){
            $q->Active()->ApiSelection()->with(['discount'=> function($q){
            $q->Active()->ApiSelection()->where('counter',0);
            }]);
        }])->with('review')->with('discount',function($q){
            $q->Active()->ApiSelection()->where('counter',0);
        })->ApiSelection()->inRandomOrder()->paginate(9);
        $feedback = Feedback::where('status',1)->with('user')->take(5)->latest()->get();
        $Category = Category::Active()->Categoryname()->get();
        $api= [
            'DisconutProducts' => ProductResource::collection($productdiscount),
            'Sliders' => $slider,
            'allProduct' => ProductResource::collection($allProduct)->response()->getData(),
            'Category' => $Category,
            'feedback' => FeedbackResource::collection($feedback),
        ];
        return Api_response('HomeComponent load successfully',200,$api);

    }
   public function allProduct(){

   }
}
