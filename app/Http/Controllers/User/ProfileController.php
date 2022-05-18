<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ProfileRequest;
use App\Mail\ResetEmail;
use App\Models\Users\EmailResets;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Facade\FlareClient\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{

    public function updateProfile(ProfileRequest $request){
       $user_id = Auth::id();
     User::where('id',$user_id)->update([
        'birthday' => $request->birthday,
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
     ]);
    return Api_response('Updated Sucessfully',200,Auth::user());
      
    }
    public function changepasswordcomponent(){
      $user =  Auth::user();
      if ($user->password == null) {
         return Api_response('',200,false);
      }
      return Api_response('',200,true);
    }
    public function changepassword(ChangePasswordRequest $request){
      $user =  User::where('id',Auth::id())->first();
      if ($user->password != null) {
         $request->validate([
            'currant_password' => 'required|max:50|min:5|string',
         ]);
      if (Hash::check($request->currant_password,$user->password)) {
         $user->update([
            'password' => Hash::make($request->password),
         ]);
         return Api_response('Password Updated Sucessfully',200,'');
       }else{
         return Api_response('Currant Password Incorrect',419,'');
       }
   }else{
      $user->update([
         'password' => Hash::make($request->password),
      ]);
      return Api_response('Password Updated Sucessfully',200,'');
   }

    }

    public function resetEmail(Request $request){
       
      $request->validate([
         'email' => 'required|max:255|min:8|email',
      ]);
      $user = Auth::user();      
      if ($user->email == $request->email) {
         $data=[
            'user' =>  $user ,
            'token'=>  Str::random(60), 
          ];
      Mail::to($user->email)
         ->send(new ResetEmail($data));
        EmailResets::create([
            'user_id' => $data['user']->id,
            'token' => $data['token'],
            'created_at' => Carbon::now(),
        ]);
        return Api_response('Email send successfully',200,'');
      }else{
         return Api_response('Email that you give is not your currant email',404,'');
      }

    }
    public function checktoken($token){
     $EmailResets = EmailResets::where([['token',$token],['active',1],['created_at','>',Carbon::now()->subMinutes(30)->toDateTimeString()]])->first();
     if (!empty($EmailResets)) {
        return Api_response('success',200,'');
     }
     return Api_response('This link is unavailable anymore',404,$token);
    }


    public function changeemail(Request $request){
      $request->validate([
         'email' => 'required|max:255|min:8|email|unique:users,email',
      ]);
      $token =EmailResets::where([['token',$request->token],['active',1],['created_at','>',Carbon::now()->subMinutes(30)->toDateTimeString()]])->first();
      if (!empty($token)) {
        $user= User::where('id',$token->user_id)->first();
         if(!empty($user)){
            $user->update([
               'email' => $request->email
            ]);
            $token->update([
               'active' => 0
            ]);
            if (Auth::check()) {
               Auth::logout();
            }
            return Api_response('Email changed successfully',200,'');
         }
      }
      return Api_response('Somthing went wrong please try again later',404,'');


    }

}
