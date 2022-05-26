<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function __construct()
{
    $this->middleware(['adminpermission:guest'])->only('index');
    $this->middleware(['adminpermission:admin'])->only('create','store');
    $this->middleware(['adminpermission:owner'])->only('update','edit');
    $this->middleware(['adminpermission:owner'])->only('destroy');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $DataTable)
    {
        return $DataTable->render('admin/pages/admins/Admins');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->user()->getRoleNames()->contains('owner')) {
           $roles = Role::get();
        }else{
         $roles = Role::where('name','!=','owner')->get();
        }
        return view('admin.pages.admins.CreateAdmin',compact('roles'));

       
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
     try {
        if (Auth::guard('admin')->user()->getRoleNames()->contains('owner')) {
            $admin =  Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'roles_name'=> $request->roles,
                
            ]);
            $admin->assignRole($request->roles);
            notfication_helper('Admin Added By',true);
            return redirect()->back()->with(notify_messages('Admin Created successFully','success'));
        }else{
            if (in_array('owner',$request->roles)) {
                return redirect()->back()->with(notify_messages('only Za3touri Can Make Owners','warning'));
            }else{
                $admin =  Admin::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'roles_name'=> $request->roles,
                    
                ]);
                $admin->assignRole($request->roles);
                notfication_helper('Admin Added By',true);
                return redirect()->back()->with(notify_messages('Admin Created successFully','success'));
            }
          
        }
     } catch (\Throwable $th) {
        return   error_on_controller();
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
       $roles= Role::get();
      $admin= Admin::findOrFail($id);
      return view('admin.pages.admins.EditAdmin',compact('admin','roles'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {     

        try {
            if ($request->id == $id) {
                $admin=  Admin::findOrFail($id);
                $admin->name=$request->name;
                $admin->email=$request->email;
                $roles = array();
              foreach ($request->roles as $role) {
                  array_push($roles,$role);
              }
               $admin->roles_name =$roles;
                $admin->save();  
                $admin->roles()->detach();
                $admin->assignRole($request->roles);
                notfication_helper('Admin Number '.$id.' Edited By',true);
      
               return redirect()->route('Admins.index')->with(notify_messages('Admin Updated Successfully','info'));
              }
              return redirect()->back()->with(notify_messages('somthing went wrong','warning'));
        } catch (\Throwable $th) {
            return   error_on_controller();
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
            Admin::findOrFail($id)->delete();
            notfication_helper('Admin Number'.$id.' Removed By',true);
            return redirect()->route('Admins.index')->with(notify_messages('Admin removed Successfully','success'));
        } catch (\Throwable $th) {
            return  error_on_controller();
        }
  
    }
}
