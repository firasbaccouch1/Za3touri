<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDatatables;
use App\Http\Controllers\Controller;
use App\Models\Users\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
 
    public function __construct()
    {
        $this->middleware(['adminpermission:update'])->only('update');
        $this->middleware(['adminpermission:update'])->only('show');
        $this->middleware(['adminpermission:guest'])->only('index');
    }
    public function index(OrdersDatatables $datatables){

        return $datatables->render('admin.pages.orders.Orders');
    }
    public function update($id,$status){
       $order= Orders::findOrFail($id);
       $order->update([
        'status' => $status,
       ]);
       return redirect()->route('admin.Orders')->with(notify_messages('Order updated successFully','info'));
    }

    public function show($id){
        $order = Orders::with('payment')->findOrFail($id);
                return view('admin.pages.orders.Order',compact('order'));
    }
}
