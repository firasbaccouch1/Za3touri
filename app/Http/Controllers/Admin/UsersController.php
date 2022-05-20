<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Users\banned;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:owner'])->only('banUser','unbanUser');
    }
    public function index(UsersDataTable $datatable){
        return $datatable->render('admin/pages/users/Users');
        
    }

    public function banUser($ip_address){
        $users =  User::where('ip_address',$ip_address)->get();
    
        foreach ($users as $user) {
        banned::create([
            'user_id' => $user->id,
            'banned_by' => Auth::guard('admin')->user()->name,
        ]); 
      
    }
    return redirect()->back()->with(notify_messages('User banned successfully','success')); 
    return redirect()->back()->with(notify_messages('somthing went wrong try later','error'));
    }
    public function unbanUser($ip_address){
        $users =  User::where('ip_address',$ip_address)->with('banned')->get();
        foreach ($users as $user) {
                $banned =  banned::where('user_id',$user->id)->first();     
                $banned->delete();    
        }
        return redirect()->back()->with(notify_messages('User unbanned successfully','success')); 
       
 
    return redirect()->back()->with(notify_messages('somthing went wrong try later','error'));
}
}
