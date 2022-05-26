<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:create'])->only('create','store');
        $this->middleware(['adminpermission:update'])->only('update','edit','active','photodelete');
        $this->middleware(['adminpermission:delete'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderDataTable $datatables)
    {
        return $datatables->render('admin.pages.sliders.Sliders');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::Categoryname()->get();
       return view('admin.pages.sliders.CreateSlider',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
       try {
        $image = $request->file('photo');
        $location = "backend/img/sliders/";
        Slider::insert([
            'title_en'=> $request->title_en,
            'title_ar'=>$request->title_ar,
            'short_description_en'=>$request->short_description_en,
            'short_description_ar'=>$request->short_description_ar,
            'photo' => save_photo($image,$location,[1920,900]),
            'category_id'=>$request->category,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
        notfication_helper('New Slider Added By');
        return redirect()->route('Slider.create')->with(notify_messages('Slider Created Successfully','success'));
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
        $categories = Category::Categoryname()->get();
        $slider = Slider::findOrFail($id);
        return view('admin.pages.sliders.EditSlider',compact('slider','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
       try {
      
        $image = $request->file('photo');
        $old_img = $request->old_photo;
        $location =  "backend/img/sliders/";
       if ($image) {
        Slider::withTrashed()->findOrFail($id)->update([
            'title_en'=> $request->title_en,
            'title_ar'=>$request->title_ar,
            'short_description_en'=>$request->short_description_en,
            'short_description_ar'=>$request->short_description_ar,
            'photo' => save_photo($image,$location,[1920,900],$old_img),
            'category_id'=>$request->category,
            'updated_at'=>Carbon::now(),
        ]);
        notfication_helper('Slider Number '.$id.' Edited By');
        return redirect()->route('Slider.index')->with(notify_messages('Slider Updated Successfully','info'));
       }else{
        Slider::withTrashed()->findOrFail($id)->update([
            'title_en'=> $request->title_en,
            'title_ar'=>$request->title_ar,
            'short_description_en'=>$request->short_description_en,
            'short_description_ar'=>$request->short_description_ar,
            'category_id'=>$request->category,
            'updated_at'=>Carbon::now(),
        ]); 
        notfication_helper('Slider Number '.$id.' Edited By');  
        return redirect()->route('Slider.index')->with(notify_messages('Slider Updated Successfully','info'));
       }
       } catch (\Throwable $th) {
        return error_on_controller();
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
            $slider = Slider::findOrFail($id);
            $slider->update([
                'deleted_by' => Auth::guard('admin')->user()->name,
            ]);
            $slider->delete();
            notfication_helper('Slider Number '.$id.' Removed By');  
            return redirect()->route('Slider.index')->with(notify_messages('Slider Deleted Successfully','error'));
        } catch (\Throwable $th) {
            return  error_on_controller();
        }
    }

    public function active($id){
        try {
            $Slider=  Slider::findOrFail($id);
            if ($Slider->active == 1) {
                 $Slider->update([
                     'active' => 0,
                 ]);
                 notfication_helper('Slider Number '.$id.' Deactivated By');  
                return redirect()->back()->with(notify_messages('Slider is InActive ','error'));
            }else{
             $Slider->update([
                 'active' => 1,
                ]);
                notfication_helper('Slider Number '.$id.' Activated By'); 
                return redirect()->back()->with(notify_messages('Slider is Active','success'));
            }
        } catch (\Throwable $th) {
            return  error_on_controller();
        }
  
      }
}
