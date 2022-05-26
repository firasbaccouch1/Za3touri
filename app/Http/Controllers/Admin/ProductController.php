<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Multi_img;
use App\Models\Admin\Product;
use App\Models\Users\User;
use App\Trait\EmailMeTrait;
use App\Notifications\EmailMe;
use App\Scopes\ProductScope;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Http\Services\EmailMeWhenPriceDrop;

class ProductController extends Controller
{
    use EmailMeTrait;
    private $EmailMeWhenPriceDrop;
    public function __construct(EmailMeWhenPriceDrop $EmailMeWhenPriceDrop)
    {
        
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:create'])->only('create','store');
        $this->middleware(['adminpermission:update'])->only('update','edit','active','photodelete');
        $this->middleware(['adminpermission:delete'])->only('destroy');
        $this->EmailMeWhenPriceDrop = $EmailMeWhenPriceDrop;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $datatables)
    {
       return $datatables->render('admin.pages.product.Products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::Categoryname()->get();
        return view('admin.pages.product.CreateProduct',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   
       
      try{

        $image = $request->file('thumbnail');
        $location =  "backend/img/Product/thamnaile/";
        $muti_img = $request->file('images');
        $location_muti_img="backend/img/Product/images/";
       $id = Product::insertGetId([
            'name_en'=> $request->name_en, 
            'name_ar'=> $request->name_ar,
            'slug'=> strtolower(str_replace(' ','_',$request->name_en)),
            'discription_en'=> $request->discription_en,
            'discription_ar'=> $request->discription_ar,
            'price'=> $request->price,
            'thumbnail'=> save_photo($image,$location,[920,720]),
            'qantite'=> $request->qantite,
            'category_id'=> $request->category,
            'updated_at'=> Carbon::now(),
            'created_at'=>  Carbon::now(),
        ]);
        if ($muti_img) {
           foreach($muti_img as $image){
             Multi_img::insert([
                   'product_id' => $id,
                   'images' => muti_img_save($image,$location_muti_img)
             ]);
             
           }
        }
        notfication_helper('New Product Added By');
        return redirect()->route("Product.create")->with(notify_messages('Product Created Successfully','success'));
    } catch (\Throwable $th) {
        return  error_on_controller();
    }
       }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Product::withoutGlobalScope(ProductScope::class)->where('id',$id)->with('discount','multi_img','category')->first();
        if ($product) {
       return view('admin.pages.product.Product',compact('product'));
    }else{
        return redirect()->back()->with(notify_messages('somthing went wrong try later','error'));
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product =  Product::withoutGlobalScope(ProductScope::class)->where('id',$id)->with('multi_img','review')->first();
        if ($product) {
            $categories = Category::Categoryname()->get();
            return view('admin.pages.product.EditProduct',compact('product','categories'));
        }else{
            return redirect()->back()->with(notify_messages('somthing went wrong try later','error'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {  
        try{ 
        $oldprice =Product::where('id',$id)->first()->price;
        $location_muti_img = 'backend/img/Product/images/';
        $muti_img= $request->file('images');
        $image = $request->file('thumbnail');
        $location =  "backend/img/Product/thamnaile/";
        $old_img = $request->old_img;
        if ($image) {
            Product::withoutGlobalScope(ProductScope::class)->withTrashed()->findOrFail($id)->update([
                'name_en'=> $request->name_en, 
                'name_ar'=> $request->name_ar,
                'slug'=> strtolower(str_replace(' ','_',$request->name_en)),
                'discription_en'=> $request->discription_en,
                'discription_ar'=> $request->discription_ar,
                'price'=> $request->price,
                'thumbnail'=> save_photo($image,$location,[1920,900],$old_img),
                'qantite'=> $request->qantite,
                'category_id'=> $request->category,
                'updated_at'=> Carbon::now(),
                'created_at'=>  Carbon::now(),
            ]);
        }else{
             Product::withoutGlobalScope(ProductScope::class)->withTrashed()->findOrFail($id)->update([
                'name_en'=> $request->name_en, 
                'name_ar'=> $request->name_ar,
                'slug'=> strtolower(str_replace(' ','_',$request->name_en)),
                'discription_en'=> $request->discription_en,
                'discription_ar'=> $request->discription_ar,
                'price'=> $request->price,
                'qantite'=> $request->qantite,
                'category_id'=> $request->category,
                'updated_at'=> Carbon::now(),
                'created_at'=>  Carbon::now(),
            ]);

        }
        if ($muti_img) {
            foreach($muti_img as $img){
              Multi_img::insert([
                    'product_id' => $id,
                    'images' => muti_img_save($img,$location_muti_img)
              ]);
              
            }
         }
         $product =Product::where('id',$id)->whereHas('emailme')->first();
         if ($product) {
            if ($oldprice > $request->price) {
               $this->EmailMeWhenPriceDrop->SendEmailToUsersProduct($product,$oldprice);
              
            }
        }
         notfication_helper('Product Number'.$id.' Edited By');
        return redirect()->back()->with(notify_messages('Product Updated Successfully','info'));
    } catch (\Throwable $th) {
        return  error_on_controller();
    }
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::withoutGlobalScope(ProductScope::class)->findOrFail($id);
            $product->update([
                'deleted_by' => Auth::guard('admin')->user()->name,
            ]);
             $product->delete();
             notfication_helper('Product Number'.$id.' Removed By');
             return redirect()->route('Product.index')->with(notify_messages('Product Deleted Successfully','success'));
        } catch (\Throwable $th) {
            return  error_on_controller();
        }
        }   

    
     
       
    public function active($id){
        try {
            $product=  Product::withoutGlobalScope(ProductScope::class)->findOrFail($id);
            if ($product->status == 1) {
                 $product->update([
                     'status' => 0,
                 ]);
                 notfication_helper('Product Number'.$id.' Deactivated By');
                return redirect()->back()->with(notify_messages('product is InActive ','error'));
            }else{
             $product->update([
                 'status' => 1,
                ]);
                notfication_helper('Product Number'.$id.' Activated By');
                return redirect()->back()->with(notify_messages('product is Active','success'));
            }
        } catch (\Throwable $th) {
            return   error_on_controller();
        }

    }

    public function photodelete($id){
        try {
                    
      $photo =  Multi_img::findOrFail($id);
      unlink($photo->images);
      $photo->forceDelete();
      return redirect()->back()->with(notify_messages('image removed successfully','success'));
        } catch (\Throwable $th) {
            return   error_on_controller();
        }
    }
}
