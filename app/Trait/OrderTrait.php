<?php

namespace App\Trait;

use App\Http\Resources\OrderResource;
use App\Models\Admin\Coupon;
use App\Models\Users\Address;
use App\Models\Users\Countries;
use App\Models\Users\Orders;
use App\Models\Users\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Trait OrderTrait{

        use CartTrait;
   
    function SaveOrder($request,$defaultAddress=false,$invoiceId,$linkpayment,$coupon){
       $user_id= Auth::id();
        if ($defaultAddress == true) {
            $defualt = Address::where([['user_id',$user_id],['default',1]])->first();
           $country= Countries::where('id',$defualt->country_id)->first();
            $address =[
                'country' => $country,
                "first_name"=> $defualt->first_name,
                "last_name"=> $defualt->last_name,
                'email' => Auth::user()->email,
                "state"=> $defualt->state,
                "city"=> $defualt->city,
                "zipcode"=> $defualt->zipcode,
                "phone"=> $defualt->phone,
                "street_address"=> $defualt->street_address,
            ];
        }else{
           $country = Countries::where('id',$request->country)->first();
            $address =  [
                'country' => $country,
                "first_name"=> $request->first_name,
                "last_name"=> $request->last_name,
                'email' => $request->email,
                "state"=> $request->state,
                "city"=> $request->city,
                "zipcode"=> $request->zip_code,
                "phone"=> $request->phone,
                "street_address"=> $request->street_address,
             ];
        }
       $CartData = $this->getCart();
        if ($coupon !=null || $coupon > 1) {
            $CartData['coupon'] =$coupon;
            $CartData['Total']= $CartData['Total'] - $coupon;
        }
        Orders::create([
            'invoice_id' => $invoiceId,
            'payment_url' => $linkpayment,
            'user_id' => $user_id,
            'order_number' => $this->generateOrderNumberNumber(),
            'status'       => 'unpaid',
            'comment' => $request->note,
            'data'  => [
                'shippingaddress' => $address,
                'purchases' => $CartData,
            ], 
        ]);  
           $this->DeleteAllCartData();
    }

    function PreperingInvoiceData($request,$defaultAddress=false){
        $user_id=Auth::id();
        if ($defaultAddress == true) {
            $address = Address::where([['user_id',$user_id],['default',1]])->first();
            $user_name = $address->first_name .' '.$address->last_name;
        }else{
            $user_name= $request->first_name .' '.$request->last_name;  
        }
        $activeReview=Coupon::where([['code',$request->coupon],['status',1]])->first();
        $CartData = $this->getCart();
        $Sub_total = $CartData['Sub_Total'];
        $total = $CartData['Total'];
        $carts =$CartData['Cart_Data'];
        $TVA = round(($Sub_total * $CartData['Tax'])/100);
        $shipping =$CartData['Shipping'];
        $coupon=null;
        if ($activeReview) {
        $coupon =round(($total*$activeReview->discount)/100);
        $total = $total - round((($total*$activeReview->discount)/100));
        }   
         $invoiceItems=[];
       foreach ($carts as $cart) {
       
            if ($cart->product->discount != null) {
                array_push($invoiceItems,[
                'ItemName'  => $cart->product->name, 
                'Quantity'  => $cart->quantity, 
                'UnitPrice' => $cart->product->price - ($cart->product->price * $cart->product->discount->discount / 100 ),
                ]);
            }else{
                array_push($invoiceItems,[
                    'ItemName'  => $cart->product->name, 
                    'Quantity'  => $cart->quantity, 
                    'UnitPrice' => $cart->product->price,
                    ]);
            }
       }
       if ($activeReview) {
        array_push($invoiceItems,[
            'ItemName'  => 'Coupon',
            'Quantity'  => '1', 
            'UnitPrice' => -$coupon,
           ]);
       }
       array_push($invoiceItems,[
        'ItemName'  => 'TVA',
        'Quantity'  => '1', 
        'UnitPrice' => $TVA,
       ]);
       array_push($invoiceItems,[
        'ItemName'  => 'Shipping',
        'Quantity'  => '1', 
        'UnitPrice' => $shipping,
       ]);
    $data =[
        'CustomerReference'  => '95929292',
        'DisplayCurrencyIso' => 'USD',
        'NotificationOption' => 'Lnk',
        'InvoiceValue'       => $total,
        'CustomerName'       => $user_name,
        'CallBackUrl'        => 'http://za3touri.com/fatoorah/callback',
        'Language'           => 'en',
        'InvoiceItems' => $invoiceItems,
    ];
    return [
        'data' => $data,
        'coupon'=>$coupon,
    ];
    }



    // generate unqie Number for orders
    function generateOrderNumberNumber() {
        $number = mt_rand(1000000000, 9999999999); 
    
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateOrderNumberNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        return Orders::where('order_number',$number)->exists();
    }

    
    function filtredOrdersby($id){
        $user_id =Auth::id();
        if ($id == 1) {
            
            $orders = Orders::where('user_id',$user_id)->latest()->take(5)->get();
            return  OrderResource::collection($orders);
           }
        if ($id == 2) {
            $orders = Orders::where([['user_id',$user_id],['created_at','>=',Carbon::now()->subdays(15)]])->latest()->get();
            return  OrderResource::collection($orders);
        }
        if ($id == 3) {
            $orders = Orders::where([['user_id',$user_id],['created_at','>=',Carbon::now()->subdays(30)]])->latest()->get();
            return  OrderResource::collection($orders);
        }
        if ($id == 4) {
            $orders = Orders::where([['user_id',$user_id],['created_at','>=',Carbon::now()->subdays(60)]])->latest()->get();
            return  OrderResource::collection($orders);
        }
        if ($id == 5) {
            $orders = Orders::where([['user_id',$user_id],['created_at','>=',Carbon::now()->subYear() ]])->latest()->get();
            return  OrderResource::collection($orders);
        }
        if ($id == 6) {
            $orders = Orders::where('user_id',$user_id)->latest()->get();
            return  OrderResource::collection($orders);
        }
    
    }


}