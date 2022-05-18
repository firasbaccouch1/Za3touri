<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use Illuminate\Support\Arr;
use stdClass;

class TrashController extends Controller
{
   public function __construct()
   {
     $this->middleware(['adminpermission:guest'])->except('delete','restore');
     $this->middleware(['adminpermission:softdelete'])->only('delete','restore');

   }
   
   public function index(){
    return view('admin.pages.trash.trash');
   }
   public function allTrashed(){
   
    $categories= Category::TrashedCategories();
     $products = Product::TrashedProducts();
     $sliders = Slider::TrashedSliders();
     $Trashed_data  = array_merge($categories,$products,$sliders);
      return response()->json([
            'status' => 200,
            'data' => $Trashed_data,
      ]);

   }
   public function category(){
   
      $categories= Category::TrashedCategories();
        return response()->json([
              'status' => 200,
              'data' => $categories,
        ]);
  
     }
     public function product(){
       $products = Product::TrashedProducts();
        return response()->json([
              'status' => 200,
              'data' => $products,
        ]);
  
     }
     public function slider(){
       $sliders = Slider::TrashedSliders();
        return response()->json([
              'status' => 200,
              'data' => $sliders,
        ]);
  
     }

    public function delete($id,$type){ 
      
         if ($type == 'category') {
            $category = Category::onlyTrashed()->where('id',$id)->first();
             $category->forceDelete();
             return response()->json('success',200);
          }
          if ($type == 'product') {
             $product = Product::onlyTrashed()->where('id',$id)->first();
             $product->forceDelete();
             return response()->json('success',200);
          } 
          if ($type == 'slider') {
             $slider = Slider::onlyTrashed()->where('id',$id)->first();
             $slider->forceDelete();
             return response()->json('success',200);
          }
  

    } 

    public function restore($id,$type){
       try {
         if ($type == 'category') {
            $category = Category::onlyTrashed()->where('id',$id)->first();
             $category->update([
                'deleted_by' => null,
                'active'=> 0,
             ]);
             $category->restore();
             return response()->json('success',200);
          }
          if ($type == 'product') {
             $product = Product::onlyTrashed()->with('category')->where('id',$id)->first();
               if ($product->category->trashed()) {
                  return response()->json([
                     'data' => 'You have to restore the category before the Product Or just Edit the product Category',
                     'status' => 303
                  ]);
               }else{
             $product->update([
                'deleted_by' => null,
                'status'=> 0,
             ]);
             $product->restore();
             return response()->json('success',200);
            }
          }
          if ($type == 'slider') {
             $slider = Slider::onlyTrashed()->with('category')->where('id',$id)->first();
             if ($slider->category->trashed()) {
               return response()->json([
                  'data' => 'You have to restore the category before the Slider Or just Edit the Slider Category',
                  'status' => 303
               ]);
             }else{
             $slider->update([
                'deleted_by' => null,
                'active'=> 0,
             ]);
             $slider->restore();
             return response()->json('success',200);
          }
         }
       } catch (\Throwable $th) {
         return response()->json('the id or the data is not found',404);
       }


    }
    public function edit($id,$type){
      if ($type == 'category') {
         $category = Category::onlyTrashed()->where('id',$id)->first();
        return view('admin.pages.categories.EditCategory',compact('category'));
      }
      if ($type == 'product') {
         $product =   Product::onlyTrashed()->where('id',$id)->with('multi_img')->first();
         $categories = Category::withTrashed()->Categoryname()->get();
         return view('admin.pages.product.EditProduct',compact('product','categories'));
      }
      if ($type == 'slider') {
         $categories = Category::withTrashed()->Categoryname()->get();
         $slider = Slider::onlyTrashed()->where('id',$id)->first();
         return view('admin.pages.sliders.EditSlider',compact('slider','categories'));
      }
   }
}
