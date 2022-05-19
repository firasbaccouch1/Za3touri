<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrdersRequest;
use App\Http\Resources\OrderResource;
use App\Http\Services\PaymentServices;
use App\Models\Users\Orders;
use App\Models\Users\Payment;
use App\Trait\CartTrait;
use App\Trait\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OrdersController extends Controller
{
    use OrderTrait;
    use CartTrait;
    private $PaymentServices;
    public function __construct(PaymentServices $PaymentServices)
    {
        $this->PaymentServices = $PaymentServices;
    }

    public function index(){
        $user_id = Auth::id();
      $orders = Orders::where('user_id',$user_id)->where('status','!=','cancel')->latest()->get();
      if (!empty($orders)) {
        $filtedOrders= OrderResource::collection($orders);
        return Api_response('success',200,$filtedOrders);
      }
      return Api_response('',404,null);

    }


    public function filteredOrders($id){
        $filted= ['1','2','3','4','5','6'];
        if (in_array($id,$filted,true)) {
           $filtedOrders = $this->filtredOrdersby($id);
            return Api_response('success',200,$filtedOrders);
        }else{
            Api_response('Somthing went Wrong please Try Again Later',404,'');
        }
    }


    public function getorder($ordernumber){
        $user_id = Auth::id();
        $order = Orders::where([['user_id',$user_id],['order_number',$ordernumber]])->with('payment',function($q){
            $q->select('order_id','payment_gateway');
        })->first();
        if ($order) {
           return Api_response('succes',200,$order);
        }
        return Api_response('Somthing went wrong please try again later',404,'');
    }



    public function PlaceOrder(OrdersRequest $request){
        try {
            $CartData = $this->getCart();
            $sub_total = $CartData['Sub_Total'];
            if ($sub_total == 0) {
                return Api_response('You Have NO Products To purchases',419,'');  
            }else{
                $data= $this->PreperingInvoiceData($request);
                $response =$this->PaymentServices->sendPayment($data['data']);
                if ($response) {
                    $InvoiceId= $response['Data']['InvoiceId'];
                    $linkpayment = $response['Data']['InvoiceURL'];
                    $coupon=$data['coupon'];
                    $this->SaveOrder($request,false,$InvoiceId,$linkpayment,$coupon);
                    return Api_response('Success',200,$linkpayment);
                }
                return Api_response('Somthing Went Wrong Please Try Again later',419,'');
                }
            } catch (\Throwable $th) {
                return Api_response('Somthing Went Wrong Please Try Again later',419,'');
            }
    }
    public function PlaceOrderWithDefaultAddress(Request $request){
      
       
               
            $request->validate([
                'note' => 'max:500|min:10|nullable'
                
            ]);
            $CartData = $this->getCart();
            $sub_total = $CartData['Sub_Total'];
            if ($sub_total == 0) {
                return Api_response('You Have NO Products To purchases',419,'');  
            }else{
            $data = $this->PreperingInvoiceData($request,true);
            $response =$this->PaymentServices->sendPayment($data['data']) ;
                if ($response) {
                    $InvoiceId= $response['Data']['InvoiceId'];
                   $linkpayment = $response['Data']['InvoiceURL'];
                   $coupon=$data['coupon']; 
                    $this->SaveOrder($request,true,$InvoiceId,$linkpayment,$coupon);
                    return Api_response('Success',200,$linkpayment);
                }
            return Api_response('Somthing Went Wrong Please Try Again later',419,'');
            }

    }
    public function callback(Request $request){
       
       $data =[
        'Key'     => $request->paymentId,
        'KeyType' => 'paymentId',
       ];
           $response = $this->PaymentServices->getPaymentStatus($data);
       if ($response) {
        $TransactionStatus=$response['Data']['InvoiceTransactions'];
        $TransactionSuccess = collect($TransactionStatus)->filter(function ($value, $key) {
            return $value['TransactionStatus'] == 'Succss';
        })->first();
                $InvoiceStatus =$response['Data']['InvoiceStatus']; 
                $InvoiceID =$response['Data']['InvoiceId'];     
                if ($InvoiceStatus == 'Paid' && !empty($TransactionSuccess)) {
                        $user_id = Auth::id();
                     $Order= Orders::where([['user_id',$user_id],['invoice_id',$InvoiceID],['status','unpaid']])->first();
                            if ($Order) {
                                $Order->update([
                                    'status' => 'paid',
                                    'payment_id'=> $request->paymentId,
                                ]);
                                $payment = Payment::create([
                                    'order_id' =>$Order->id,
                                    'user_id' =>$user_id,                        
                                    'payment_date' => $TransactionSuccess['TransactionDate'],
                                    'payment_gateway' => $TransactionSuccess['PaymentGateway'],
                                    'payment_id' => $TransactionSuccess['PaymentId'],
                                    'payment_amout' => $TransactionSuccess['DueValue'],
                                    'paid_currency' => $TransactionSuccess['PaidCurrency'],
                                    'id_address' => $TransactionSuccess['IpAddress'],
                                    'country' =>$TransactionSuccess['Country'],
                                    'card_number' =>$TransactionSuccess['CardNumber'],
                                    
                                ]);
                                Alert::success('Payment Successful','Transaction completed successfully , thank you for trusting us');
                                return redirect('/');
                            }
                            Alert::error('Oops!','Somthing went wrong please try again later');
                            return redirect('/');
                           
                 }else{
                    Alert::error('Oops!','Payment Fail please try again later');
                    return redirect('/');
                }
       }else{
        Alert::error('Oops!','Somthing went wrong please try again later');
        return redirect('/');
       }
    }
    public function CancelOrder($order_number){
      $user_id = Auth::id();
      $Order= Orders::where([['user_id',$user_id],['order_number',$order_number],['status','paid']])->first();
      if ($Order) {
        $Order->update([
            'status' => 'cancel',
            'updated_at' => Carbon::now(),
        ]);
        return Api_response('Order number '.$order_number.' canceled Successfully',200,'');
      }else{
          return Api_response('Somthing went wrong please try again later',404,'');
      }
    }
    public function getcancelorders(){
        $user_id = Auth::id();
        $orders = Orders::where('user_id',$user_id)->where('status','cancel')->latest()->get();
        if (!empty($orders)) {
          $filtedOrders= OrderResource::collection($orders);
          return Api_response('success',200,$filtedOrders);
        }
        return Api_response('',404,null);
    }
    public function unCancelOrder($order_number){
        $user_id = Auth::id();
        $Order= Orders::where([['user_id',$user_id],['order_number',$order_number],['status','cancel']])->first();
        if ($Order) {
          $Order->update([
              'status' => 'paid',
              'updated_at' => Carbon::now(),
          ]);
          return Api_response('Order number '.$order_number.' uncanceled Successfully',200,'');
        }else{
            return Api_response('Somthing went wrong please try again later',404,'');
        }
    }


}
