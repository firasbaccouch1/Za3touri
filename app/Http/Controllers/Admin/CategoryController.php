<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Admin\Category;
use Carbon\Carbon;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    
    public function __construct()
    {
        
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:create'])->only('create','store');
        $this->middleware(['adminpermission:update'])->only('update','edit','active');
        $this->middleware(['adminpermission:delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('admin.pages.categories.Category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       return view('admin.pages.categories.CreateCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       try {
       $Category = Category::insert([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'slug' => strtolower(str_replace(' ','_',$request->name_en)),
            'icon' => $request->icon,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
       ]);
       notfication_helper('Category added by');
       return redirect()->back()->with(notify_messages('Category Created Successfully','success'));
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


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.pages.categories.EditCategory',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            Category::withTrashed()->findOrFail($id)->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'slug' => strtolower(str_replace(' ','_',$request->name_en)),
                'icon' => $request->icon,
                'updated_at'=>Carbon::now(),
            ]);
            notfication_helper('Category number '.$id.' Edited by');
            return redirect()->back()->with(notify_messages('Updated successfully','info'));
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
        $category= Category::findOrFail($id);
        $category->update([
            'deleted_by' => Auth::guard('admin')->user()->name
    ]);
             $category->delete();
           notfication_helper('Category number '.$id.' Removed by');
        return redirect()->route('Category.index')->with(notify_messages('Deleted Successfuly','success'));
     } catch (\Throwable $th) {
     return error_on_controller();
 
     }
    }

    public function active($id){
        try {
            $category=  Category::findOrFail($id);
            if ($category->active == 1) {
                 $category->update([
                     'active' => 0,
                 ]);
                 notfication_helper('Category number '.$id.' Deactivated by');
                return redirect()->back()->with(notify_messages('Category is InActive ','warning'));
            }else{
             $category->update([
                 'active' => 1,
                ]);
                notfication_helper('Category number '.$id.' Activated by');
                return redirect()->back()->with(notify_messages('Category is Active','success'));
            }
        } catch (\Throwable $th) {
            return  error_on_controller();
        }

    }


}
