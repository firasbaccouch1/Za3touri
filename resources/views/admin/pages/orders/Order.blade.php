@extends('Master_pages.Admin')
@section('title','Order')
@section('style')
<style>
    .u-s-m-b-8{
    color: rgba(0, 0, 0, 0.774);
}
</style>
@endsection
@section('content')
<div>
<link rel="stylesheet" href="{{ asset('frontend/app.css') }}">
<a href="{{ route('admin.Orders') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
<div class="col-sm-12 text-center">
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <div class="row">
                <div class="col-lg-12 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Order BY</h2>

                    <h4 class="dash__text"><b>{{ $order->data['shippingaddress']['first_name']}}  {{ $order->data['shippingaddress']['last_name'] }}</b></h4>
                </div>
            </div>             
            <br><br>
            <div class="row">
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Order Number</h2>

                     <span class="dash__text"><b>{{ $order->order_number }}</b></span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Status</h2>
                    @if ($order->status == 'status' ) 
                    <span class="badge badge-pill badge-primary">Paid</span>
                    @elseif ($order->status == 'cancel')
                    <span class="badge badge-pill badge-danger">Cancel</span>
                    @elseif ($order->status == 'shipped')
                    <span class="badge badge-pill badge-warning">Shipped</span>
                    @elseif ($order->status == 'delivered')
                    <span class="badge badge-pill badge-success">Delivered</span>
                    @elseif ($order->status == 'unpaid')
                    <span class="badge badge-pill badge-dark">Unpaid</span>
                    @endif
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Total</h2>

                     <span style="color: red"  class="dash__text"><b>${{  $order->data['purchases']['Total'] }}</b></span>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Email</h2>
                     <span class="dash__text"><b>{{ $order->data['shippingaddress']['email'] }}</b></span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Billing Address</h2>
                    <span class="badge badge-pill badge-primary">{{ $order->data['shippingaddress']['country']['nicename'] }} {{ $order->data['shippingaddress']['state']  }} {{ $order->data['shippingaddress']['city'] }} {{ $order->data['shippingaddress']['zipcode'] }} </span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Phone</h2>
                     <span style="color: rgb(66, 68, 207))"  class="dash__text"><b>(+{{ $order->data['shippingaddress']['country']['phonecode'] }})  {{ $order->data['shippingaddress']['phone'] }}</b></span>
                </div>
            </div>
            <hr>
            <br>
            <br>
            @if ($order->payment != null)
            <div class="row">
                <div class="col-lg-12 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Payment gateway </h2>

                    <h4 class="dash__text"><b>{{ $order->payment->payment_gateway}}</b></h4>
                </div>
            </div> 
            <br>
            <br>  
            <div  class="row">
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Country</h2>
                     <span class="dash__text"><b>{{ $order->payment->country}}</b></span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Payment Amout</h2>
                    <span class="badge badge-pill badge-info">{{ $order->payment->payment_amout }} {{ $order->payment->paid_currency }}</span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Id Address</h2>
                     <span style="color: rgb(207, 158, 66)"  class="dash__text"><b>{{ $order->payment->id_address }}</b></span>
                </div>
            </div>
         
            <hr>
            <br>
            <br>
            @endif
            <div class="row">
                <div class="col-lg-12 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Products </h2>
                </div>
            </div> 
            <br>
            <br>  
            <div class="row">
                @foreach ($order->data['purchases']['Cart_Data'] as $product)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ asset($product['product']['thumbnail']) }}" alt="Card image cap" class="card-img-top">
                        @if ($product['product']['discount'] != null)
                        <div class="text-center"><span >price -- ${{ $product['product']['price']-($product['product']['price']*$product['product']['discount']['discount']/100) }} --- <s>${{ $product['product']['price'] }}</s> </span>
                        </div>
                        @else
                        <div class="text-center"><span >price -- ${{ $product['product']['price'] }}</span>
                        </div>
                        @endif
                        <div class="text-center"><span><i class='{{ $product['product']['category']['icon'] }}'></i></span>
                        </div>
                         <div class="text-center"><span class="btn btn-info">Quantity {{ $product['quantity'] }}</span>
                         </div>
                    </div>
                </div>
              
                @endforeach
            </div> 
           
</div>
</div>
</div>
</div>
@endsection