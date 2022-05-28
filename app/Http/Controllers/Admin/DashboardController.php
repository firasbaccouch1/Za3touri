<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\passwordRequest;
use App\Models\Users\Feedback;
use App\Models\Users\Message;
use App\Models\Users\Orders;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashbord(){
        $user_today =User::whereDate('created_at',Carbon::today())->count();
        $orders_today=Orders::where('status','paid')->whereDate('created_at',Carbon::today())->count();
        $message_today =Message::whereDate('created_at',Carbon::today())->count();
        $cancel_order_today =Orders::where('status','cancel')->whereDate('created_at',Carbon::today())->count();
        $feedback = Feedback::whereDate('created_at',Carbon::today())->count();
        $order_month = $orders= Orders::where('status','paid')->whereMonth('created_at','>=',Carbon::now()->subMonth())->count();
        $orders= Orders::where('status','paid')->whereMonth('created_at','>=',Carbon::now()->subMonth())->get();
        $earning_thismonth=0;
        foreach ($orders as  $value) {
            $earning_thismonth = $earning_thismonth + $value['data']['purchases']['Total'];
        }
        $orders= Orders::where('status','paid')->get();
        $earning_all=0;
        foreach ($orders as  $value) {
            $earning_all = $earning_all + $value['data']['purchases']['Total'];
        }
        $api=[
        'users' => $user_today,
        'order' => $orders_today,
        'message' => $message_today,
        'cancelorders' => $cancel_order_today,
        'feedback' => $feedback,
        'earning_month' => $earning_thismonth,
        'all_earning' => $earning_all,
        'order_month' => $order_month
        ];
        return view('admin.pages.Dashboard',compact('api'));
    }
 
    public function logout(){
        Auth::logout();
       return redirect()->route('admin.login');
    }

    public function profile(){
             $admin = Auth::guard('admin')->user();
            return view('admin.Auth.profile',compact('admin'));
    }
    public function update(Request $request){
        try {
           
            $validated = $request->validate([
                'photo' =>'required|mimes:'.Photo_Extension(),
     
            ]);
            $location ='backend/img/Admins/Admins/';
            $admin=   Auth::guard('admin')->user();
            $old_photo = $admin->photo;
            $photo = $request->file('photo');
            if ($admin->photo == 'backend/img/Admins/defualt/defualt.webp') {
                $admin->update([
                    'photo' => save_photo($photo,$location,[420,320])
                ]);
        
            }else{
                $admin->update([
                    'photo' => save_photo($photo,$location,[420,320],$old_photo)
                ]);
            }
        return redirect()->back()->with(notify_messages('Photo Changed Successfully','success'));    
        } catch (\Throwable $th) {
            return  error_on_controller();
        }
    }



        public function password(){
    return view('admin.Auth.changepassword');
    }   





    public function changepassword(passwordRequest $request){
        try {
            $admin=Auth::guard('admin')->user();

            if (Hash::check($request->current_password,$admin->password) ) {
                $admin->update([
                    'password' => Hash::make($request->password),
                ]);
                return redirect()->back()->with(notify_messages('Password Changed Successfully','success'));
          }else{
              Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with(notify_messages('Current Password Does Not Match','warning'));
          }
        } catch (\Throwable $th) {
            return  error_on_controller();
        }
    }

    
}
