<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DiscountsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DiscountRequest;
use App\Http\Services\DiscountCheckingData;
use App\Http\Services\EmailMeWhenPriceDrop;
use App\Models\Admin\Category;
use App\Models\Admin\Discount;
use App\Models\Admin\Product;
use App\Scopes\DiscountScope;
use Carbon\Carbon;

class DiscountController extends Controller
{
    
    private $checkingdata;
    private $EmailMeWhenPriceDrop;
    public function __construct(EmailMeWhenPriceDrop $EmailMeWhenPriceDrop,DiscountCheckingData $checkingdata)
    {  
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:create'])->only('create','store');
        $this->middleware(['adminpermission:update'])->only('update','edit','active');
        $this->middleware(['adminpermission:delete'])->only('destroy');
        $this->EmailMeWhenPriceDrop =$EmailMeWhenPriceDrop;
        $this->checkingdata=$checkingdata;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DiscountsDataTable $datatables)
    {
       return $datatables->render('admin.pages.discounts.Discount');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.discounts.CreateDiscount');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        try {
     
                $counter = 0;
              if ($request->counter) {
                 $counter = 1;
              }
            $result=  $this->checkingdata->CheckingDiscount($request);
              if($result == false){
                return redirect()->back()->with(notify_messages('Can\'t discount product or category that has discount','error'));
              } 
            if ($request->category == null) {
                Discount::insert([
                    'discount'=>$request->discount,
                    'product_id'=>$request->product,
                    'expired_at'=>$request->expiry_date,
                    'counter' => $counter,
                    'updated_at'=>Carbon::now(),
                ]);
                notfication_helper('Discount Created By',true);
            }else{
                Discount::insert([
                    'discount'=>$request->discount,
                    'category_id'=>$request->category,
                    'expired_at'=>$request->expiry_date,
                    'updated_at'=>Carbon::now(),
                ]);
                notfication_helper('Discount Created By',true);
            }
            return redirect()->route('Discount.index')->with(notify_messages('Discount Added Successfully','success'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $discount = Discount::findOrFail($id);
       return view('admin.pages.discounts.EditDiscount',compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, $id)
    {
       try {
        $result=  $this->checkingdata->CheckingDiscount($request);
        if($result == false){
          return redirect()->back()->with(notify_messages('Can\'t discount product or category that has discount','error'));
        } 
        if ($request->category == null) {
            Discount::findOrFail($id)->update([
                'discount'=>$request->discount,
                'product_id'=>$request->product,
                'category_id'=>null,
                'expired_at'=>$request->expiry_date,
                'updated_at'=>Carbon::now(),
            ]);

        }else{
            Discount::findOrFail($id)->update([
                'discount'=>$request->discount,
                'product_id'=>null,
                'category_id'=>$request->category,
                'expired_at'=>$request->expiry_date,
                'updated_at'=>Carbon::now(),
            ]);

    }
    notfication_helper('Discount updated By');
    return redirect()->route('Discount.index')->with(notify_messages('Discount Updated Successfully','info'));
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
            $discount = Discount::findOrFail($id);
            $discount->delete();
             notfication_helper('Discount Number'.$id.' Deleted');
             return redirect()->back()->with(notify_messages('discount deleted Successfully','success'));
        } catch (\Throwable $th) {
            return    error_on_controller();
        }
    }

    
        public function active($id){
        
                $discount=  Discount::findOrFail($id);
                if ($discount->status == 1) {
                     $discount->update([
                         'status' => 0,
                     ]);
                     notfication_helper('Discount Number'.$id.' Deactivated By');
                    return redirect()->back()->with(notify_messages('discount is InActive ','warning'));
                }else{
                    $discount->update([
                        'status' => 1,
                       ]);
                       if ($discount->product_id) {
                            $product = Product::where('id',$discount->product_id)->whereHas('emailme')->first();
                            if ($product) {
                            $this->EmailMeWhenPriceDrop->SendEmailToUsersDiscount($product,$discount);
                            }
                         }else{
                            $products = Product::where('category_id',$discount->category_id)->whereHas('emailme')->get();
                                foreach ($products as  $product) {
                                    $this->EmailMeWhenPriceDrop->SendEmailToUsersDiscount($product,$discount);
                                 }
                            

                         }
                    notfication_helper('Discount Number'.$id.'Activated By');
                    return redirect()->back()->with(notify_messages('discount is Active','success'));
                }

    
        }
    
    public function categories(){
        $categories= Category::select('id','name_en as name')->doesntHave('discount')->whereDoesntHave('product', function($q){
            $q->has('discount');
       })->get();
      if ($categories->count() >= 1) {
        return response()->json($categories);
      }
       else{
        return response()->json('there is no Category',404);
     }
    }
    public function products(){
       $products= Product::select('id','name_en as name')->doesntHave('discount')->whereDoesntHave('category', function($q){
            $q->has('discount');
        })->get();
     if ($products->count() >= 1) {
        return response()->json($products);
     }else{
        return response()->json('there is no product',404);
     }
    }
    public function allproducts($id){
        $productsdoesntHave=  Product::select('id','name_en as name')->doesntHave('discount')->whereDoesntHave('category', function($q){
            $q->has('discount');
        })->get();
        $product=Product::where('id',$id)->select('id','name_en as name')->first();
        if ($product) {
            $products = $productsdoesntHave->push($product);
            return response()->json($products);
        }
        if ($productsdoesntHave->count() >= 1) {      
        return response()->json($productsdoesntHave);
         } else{
            return response()->json('there is no product',404);
         }
    }
    public function allcategories($id){
        $categoriesdoesntHave= Category::select('id','name_en as name')->doesntHave('discount')->whereDoesntHave('product', function($q){
            $q->has('discount');
       })->get();
        $category=Category::where('id',$id)->select('id','name_en as name')->first();
        if ($category) {
            $categories = $categoriesdoesntHave->push($category);
        return response()->json($categories);
        }
        if ($categoriesdoesntHave->count() >= 1) {

        return response()->json($categoriesdoesntHave);
    } else{
        return response()->json('there is no product',404);
     }
    }
}
