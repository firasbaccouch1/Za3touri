@extends('Master_pages.Admin')
@section('content')
<div class="col-sm-12 text-center">
    <a href="{{ route('Settings.edit',settings()->id) }}"  class="float-right btn btn-primary"><span><i style="padding-right:10px" class="fas fa-edit fa-lg"></i></span>Edit</a>
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1>  <b class="text-center " style="color: rgba(155, 161, 165, 0.692)">Site Settings</b></h1>
            <br><br>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Site name english</h2>

                     <span class="dash__text"><b>{{ $setting->name_en }}</b></span>
                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Site name arabic</h2>

                    <span class="dash__text"><b>{{ $setting->name_ar }}</b></span>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Email</h2>
                    <span class="dash__text">{{ $setting->email }}</span>
                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Status</h2>
                    @if ($setting->status == 1 ) 
                    <span class="badge badge-pill badge-success">working</span>
                    @else
                        <span class="badge badge-pill badge-warning">maintenance</span>
                    
                    @endif
                </div>
        
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Shipping</h2>
                    <span class="badge badge-pill badge-primary">${{ $GeneralSetting->shipping  }}</span>
                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Tax</h2>
                        <span class="badge badge-pill badge-info">%{{ $GeneralSetting->tax }}</span>
                </div>
        
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">logo top</h2>
                  <img src="{{ asset($setting->logo_top) }}" style="width: 60px" alt="">
                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">logo site</h2>
                  <img src="{{ asset($setting->logo_site) }}" style="width: 60px" alt="">
                </div>
            </div>
            <br><br>
            <br>
            <hr>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">tags</h2>
                    @if ($setting->tags)
                    <span class="dash__text"><b>{{ $setting->tags }}</b></span>
                    @else
                    <span class="dash__text"><b>No tags</b></span>
                    @endif
                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">description</h2>
                    @if ($setting->description)
                    <span class="dash__text"><b>{{ $setting->description }}</b></span>
                    @else
                    <span class="dash__text"><b>No Description</b></span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">maintenance message</h2>
                    @if ($setting->maintenance_message)
                    <span class="dash__text"><h2 class="badge  badge-info" >{{ $setting->maintenance_message }}</h2></span>
                    @else
                    <span class="dash__text"><b>No message</b></span>
                    
                    @endif
                    <h2 class=" u-s-m-b-8">maintenance photo</h2>
                    <br><br>
                    <img src="{{ asset($setting->maintenance_photo) }}" style="width: 400px;border-radius:60px;" alt="">
                </div>
            </div>
    </div>
</div>
</div>
@endsection