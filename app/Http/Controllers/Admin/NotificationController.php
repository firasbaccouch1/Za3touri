<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class NotificationController extends Controller
{

    public function index(){
      $notifications =  auth()->user()->unreadNotifications->pluck('data');
      if ($notifications->count() >0) {
        return response()->json($notifications);
      }
       

    }

    public function readnotification(){
            $user=  auth()->user();
            foreach ($user->unreadNotifications as $notification) {
             $notification->markAsRead();
            }
            return response()->json('success',200);
        }
             
}
