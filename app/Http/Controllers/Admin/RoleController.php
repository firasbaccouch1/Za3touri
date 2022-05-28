<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

  public function __construct()
  {
   
    $this->middleware(['adminpermission:guest'])->only('index');
    $this->middleware(['adminpermission:owner'])->only('create','store');
    $this->middleware(['adminpermission:owner'])->only('update','edit');
    $this->middleware(['adminpermission:owner'])->only('destroy');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $datatables)
    {
       return $datatables ->render('admin/pages/roles/Roles');  
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
      $permissions =  Permission::where('guard_name','admin')->latest()->get();
        return view('admin.pages.roles.CreateRole',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {    
     
      try {
        $role =  Role::create([
          'name' => $request->name,
          'guard_name'=> $request->guard_name
         ]);
         
        $role->syncPermissions($request->permissions);
 
        return redirect()->back()->with(notify_messages('Role Created Successfully','success'));
      } catch (\Throwable $th) {
        return  error_on_controller();
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
      
            $role = Role::findOrFail($id);
         $permissions = Permission::get();
          $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
            return view('admin.pages.roles.EditRole',compact('permissions','role','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, $id)
    {
     
       try {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();
        $role->syncPermissions($request->permissions);
       
          return redirect()->route('Roles.index')->with(notify_messages('Role Updated Successfully','info'));
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
        Role::FindOrFail($id)->delete();
        return redirect()->route('Roles.index')->with(notify_messages('Role Deleted Successfully','success'));
      } catch (\Throwable $th) {
        return error_on_controller();
      }

    }
}
