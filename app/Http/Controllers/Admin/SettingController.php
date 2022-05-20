<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingsRequest;
use App\Models\Admin\GeneralSettings;
use App\Models\Admin\Setting;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\SweetAlertServiceProvider;
use RealRashid\SweetAlert\ToSweetAlert;

class SettingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['adminpermission:guest'])->only('index');
        $this->middleware(['adminpermission:owner'])->except('index');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $setting =  Setting::first();
     $GeneralSetting = GeneralSettings::first();
        return view('admin.pages.settings.setting',compact('setting','GeneralSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $Settings = Setting::where('id',$id)->first();
        $GeneralSetting = GeneralSettings::first();
        return view('admin.pages.settings.editsetting',compact('Settings','GeneralSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteSettingsRequest $request, $id)
    {   
        try {
            $location_logo_top = 'backend/img/settings/logo_top/';
            $location_logo_site = 'backend/img/settings/logo_site/';
            $location_maintenance = 'backend/img/settings/maintenance/';
            $logo_top = $request->file('logo_top');
            $logo_site = $request->file('logo_site');
            $maintenance_photo = $request->file('maintenance_photo');
            Setting::where('id',$id)->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description' => $request->description,
                'maintenance_message' => $request->maintenance_message,
                'email' => $request->email,
                'tags' => $request->tags,
                'status' => $request->status,
            ]);
            if ($logo_site) {
            Setting::where('id',$id)->update([
                'logo_site' => save_photo_settings($logo_site,$location_logo_site,$request->old_logo_site,'logo_site')
            ]);
            }
            if ($logo_top) {
                Setting::where('id',$id)->update([
                    'logo_top' => save_photo_settings($logo_top,$location_logo_top,$request->old_logo_top,'logo_top')
                ]);
            }
            if ($maintenance_photo) {
                Setting::where('id',$id)->update([
                    'maintenance_photo' => save_photo_settings($maintenance_photo,$location_maintenance,$request->old_maintenance_photos,'maintenance_photo',[2340,1140])
                ]);
            }
            GeneralSettings::first()->update([
                'tax' => $request->tax,
                'shipping' => $request->shipping,
            ]);
            
            return redirect()->route('Settings.index')->with(notify_messages('settings updated Seccessfully','info'));
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
        //
    }
    public function ClearCache(){
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:cache');
            Artisan::call('route:cache');
            Artisan::call('config:cache');
            Artisan::call('config:clear');
            Artisan::call('optimize:clear');
                return 'Cached - Cleared';
        } catch (\Throwable $th) {
           return 'somthing went wrong';
        }
    }
    public function banned(){
        $users= User::where('ip_address',request()->ip())->with('banned')->get();
        foreach ($users as  $user) {
          if ($user->banned != null) {
            return view('admin.pages.settings.Banned');
          
          }
        }
         return redirect('/');
       
    }
}
