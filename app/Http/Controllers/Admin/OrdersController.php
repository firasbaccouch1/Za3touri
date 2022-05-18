<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDatatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(OrdersDatatables $datatables){

        return $datatables->render('admin.pages.orders.Orders');
    }
    public function update($id,$status){
        return [
            $id,
            $status
        ];
    }
}
