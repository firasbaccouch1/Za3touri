<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginContoller extends Controller
{
   public function index(){

    return view('admin.Auth.login');
    
   }

   public function login(LoginRequest $request){

    try {
        $credentials = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::guard('admin')->attempt($credentials)) {
            notfication_helper('Admin is logged in',true);
         return redirect()->route('admin.dashbord')->with(notify_messages('successfully logged in','success'));
        }else{
            return redirect()->back()->with(notify_messages('email or passwrod wrong','warning'));
        }
    } catch (\Throwable $th) {
        return   error_on_controller();
    }

   }

  
}
