<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:create'])->only('create','store');
        $this->middleware(['adminpermission:update'])->only('update','edit');
        $this->middleware(['adminpermission:delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponDataTable $datatables)
    {
        return $datatables->render('admin.pages.coupons.Coupon');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.coupons.CreateCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {

        try {
            Coupon::create([
                'discount' => $request->discount,
                'code' => $request->code,
                'expiry_date' => $request->expiry_date,
            ]);
                notfication_helper('New Coupon Created By',true);
            return redirect()->route('Coupon.index')->with(notify_messages('Coupon Created Successfully','success'));
          } catch (\Throwable $th) {
             return error_on_controller();
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
        $coupon = Coupon::findOrFail($id);
        return view('admin.pages.coupons.EditCoupon',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        try {
                Coupon::findOrFail($id)->update([
                    'discount'=>$request->discount,
                    'code'=>$request->code,
                    'expiry_date'=>$request->expiry_date,
                ]);
                notfication_helper('Coupon updated By');
        return redirect()->route('Coupon.index')->with(notify_messages('Coupon Updated Successfully','info'));
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
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
             notfication_helper('Coupon Number'.$id.' Deleted');
             return redirect()->back()->with(notify_messages('Coupon deleted Successfully','success'));
        } catch (\Throwable $th) {
            return    error_on_controller();
        }
    }
    public function active($id){
        try {
            $coupon=  Coupon::findOrFail($id);
            if ($coupon->status == 1) {
                 $coupon->update([
                     'status' => 0,
                 ]);
                 notfication_helper('Coupon Number'.$id.' Deactivated By');
                return redirect()->back()->with(notify_messages('Coupon is InActive ','warning'));
            }else{
             $coupon->update([
                 'status' => 1,
                ]);
                notfication_helper('Coupon Number'.$id.' Activated By');
                return redirect()->back()->with(notify_messages('Coupon is Active','success'));
            }
        } catch (\Throwable $th) {
            return  error_on_controller();
        }

    }
}
