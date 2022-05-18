<?php

use App\Models\Admin\Admin;
use App\Models\Admin\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Events\NotificatonRecieved;
use App\Notifications\allNotifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;


// this for notify messages 
if (!function_exists('notify_messages')) {
    function notify_messages($message,$type){
        return  array(
            'message'=>$message,
            'alert-type'=>$type,
       );
    }
}
// for active in active in slider 
if (!function_exists('Active_html')) {
    function Active_html($route_name){
        $route = Route::current()->getName(); 
       if ($route_name == $route) {
          return 'active';
       }
    }
}
// save photo
if (!function_exists('save_photo')) {
    function save_photo($image,$location,$resolution, $old_img =null){
        $img_name = time();
        $last_img =$location.$img_name.'.webp';
        $firas = Image::make($image)->resize($resolution[0],$resolution[1])->encode('webp',90);
        $firas->save(public_path($location.$img_name.'.webp'));
        if (!$old_img == null) {
            unlink($old_img);
        }
        return $last_img;
    }
}
//site setting save img
if (!function_exists('save_photo_settings')) {
    function save_photo_settings($image,$location, $old_img =null,$name,$resolution=[240,240]){
        if (!$old_img == null) {
            unlink($old_img);
        }
        $img_name = $name.'.webp';
        $last_img =$location.$img_name;
        $img = Image::make($image)->resize($resolution[0],$resolution[1])->encode('webp',90);
        $img->save(public_path($location.$img_name));

        return $last_img;
    }
}
// save multi img
if (!function_exists('muti_img_save')) {
    function muti_img_save($image,$location_muti_img){
        $img_name = Str::random(20).'.webp';
        $last_img =$location_muti_img.$img_name;
        $img = Image::make($image)->resize(1200,1200)->encode('webp',90);
        $img->save(public_path($location_muti_img.$img_name));      
        
        return $last_img;
    }
}

// site sitting

if (!function_exists('settings')) {
    function settings(){
       return  Setting::first();
    }
}

// notification

if (!function_exists('notfication_helper')) {
    function notfication_helper($message, $except_auth_id = false){
        if ($except_auth_id == true) {
            $admins= Admin::where('id','!=',Auth::guard('admin')->id())->get();
            $title=$message;
            Notification::send($admins, new allNotifications($title));
            event(new NotificatonRecieved($title));
        }else{
            $admins= Admin::all();
            $title=$message;
            Notification::send($admins, new allNotifications($title));
            event(new NotificatonRecieved($title));
        }
    }
}
// photo Extension allowed
if (!function_exists('Photo_Extension')) {
    function Photo_Extension(){
        return "'jpg,jpeg,webp,png,'";
    }
}
// filed try in controllers retrun ->
if (!function_exists('error_on_controller')) {
    function error_on_controller($route = null){
        if (!$route == null) {
            return redirect()->route($route)->with(notify_messages('somthing went wrong try again leter please','error'));
        }
       return redirect()->back()->with(notify_messages('somthing went wrong try again leter please','error'));
    }
}
// Api response 
if (!function_exists('Api_response')) {
    function Api_response($msg = null,$status= 200,$data=null){
        return response()->json([
            'msg' => $msg,
            'data' => $data,
        ],$status);
    }
}












