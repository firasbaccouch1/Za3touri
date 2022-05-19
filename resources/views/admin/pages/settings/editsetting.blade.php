@extends('Master_pages.Admin')
@section('title','Edit Site Setting')
@section('style')
<style>
  .thumb{
    padding: 10px;
    border-radius: 50px;
  }
</style>
@endsection
@section('content')

<a href="{{ route('Settings.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row">
                <div class='col-sm-12'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit Site Setting</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Settings.update',$Settings->id) }}" enctype="multipart/form-data" >
                        @csrf
                        @method('PATCH')

                        <div class="form-group row text-center"> 
                            <input type="hidden" name="old_logo_top" value="{{ $Settings->logo_top }}">
                            <input type="hidden" name="old_logo_site" value="{{ $Settings->logo_site }}" >
                            <input type="hidden" name="old_maintenance_photos" value="{{ $Settings->maintenance_photo }}" >
                          <div class="col-sm-6 ">
                            <span class="color-gray">Site name en english</span>
                            <input type="text" name="name_en"  value="{{ $Settings->name_en }}" class="form-control form-control-user"  >
                            <br>
                          </div>
                          
                          <div class="col-sm-6">
                            <span>Site name en arabic</span>
                            <input type="text" name="name_ar"   value="{{ $Settings->name_ar }}" class="form-control form-control-user"  >
                          </div>
                        </div>
                        <div class="form-group row text-center">
                           
                          <div class="col-sm-12 ">
                            <span>Site discription </span>
                            <textarea type="text" name="description"    class="form-control form-control-user"  >{{ $Settings->description }}</textarea>
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center">
                        <div class="col-sm-12">
                            <span>Maintenance Message</span>
                            <textarea type="text" name="maintenance_message"  class="form-control form-control-user"  >{{ $Settings->maintenance_message }}</textarea>
                          </div>
                        </div>
                        <div class="form-group row text-center">
                         
                        <div class="col-sm-6 ">
                          <span>Site Email</span>
                          <input type="text" name="email" value="{{ $Settings->email }}" class="form-control form-control-user"  >
                          <br>
                        </div>
                        
                        <div class="col-sm-6">
                          <span>Site tags</span>
                          <input type="text" name="tags" value="{{ $Settings->tags }}" class="form-control form-control-user"  >
                        </div>
                      </div>
                      <div class="form-group row text-center">
                         
                        <div class="col-sm-6 ">
                          <span>$ - Shipping</span>
                          <input type="text" name="shipping" value="{{ $GeneralSetting->shipping }}" class="form-control form-control-user"  >
                          <br>
                        </div>
                        
                        <div class="col-sm-6">
                          <span>% - Tax</span>
                          <input type="text" name="tax" value="{{ $GeneralSetting->tax }}" class="form-control form-control-user"  >
                        </div>
                      </div>
                      <div class="form-group row text-center">
                        <div class="col-sm-12">
                          <span>Site Status</span>
                        <select name="status" class="form-control" style="padding: 0.3rem 0.75rem;border-radius: 50px; ">

                               <option {{ $Settings->status == 1? 'selected':'' }} value="1">Working</option>
                                <option {{ $Settings->status == 0? 'selected':'' }}  value="0">Maintenance</option>
                        </select>
                    </div> 
                      </div>
                      <div class="form-group row text-center">
                            
                        <div class=" col-sm-8">
                            <span>Site Logo</span>
                      <input type="file" name="logo_top" class=" form-control " onChange="LogoTop(this)" style="padding: 0.3rem 0.75rem;border-radius: 50px;">
                      </div>
                      <div class="col-sm-4">
                      <img src="{{ asset($Settings->logo_top) }}" id="logo_top" width="45px"  style="border-radius: 10rem;margin-top: 30px;" class='text-center'>
                    </div>
                </div>
                <br>
                <div class="row text-center">
                    <div class=" col-sm-8">
                     <span>Site Main Logo </span>
                  <input type="file" name="logo_site" class=" form-control " onChange="LogoSite(this)" style="padding: 0.3rem 0.75rem;border-radius: 50px;">
                  </div>
                  <div class="col-sm-4">
                  <img src="{{ asset($Settings->logo_site) }}" id="logo_site" width="45px"  style="border-radius: 10rem;margin-top: 30px;" class='text-center'>
                </div>
            </div>
            <div class="row text-center">
                <div class=" col-sm-12">
                 <span>maintenance photo </span>
              <input type="file" name="maintenance_photo" class=" form-control " onChange="MaintenancePhoto(this)" style="padding: 0.3rem 0.75rem;border-radius: 50px;">
              </div>
        </div>
        <div>
            <div class="col-sm-12">
                <img src="{{ asset($Settings->maintenance_photo) }}" id="maintenance_photo" width="100%" height="50%"  style="border-radius: 10rem;margin-top: 30px;" class='text-center'>
              </div>
        </div>
                    
                
                       
              
                       <br><br>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                          update
                        </button>
                        <hr>
                       
                      </form>
                    </div>
                    </div>
                </div>
          
@endsection
@push('scripts')
<script type="text/javascript">
  function LogoTop(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#logo_top').attr('src',e.target.result).width(45).height(45);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function LogoSite(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#logo_site').attr('src',e.target.result).width(45).height(45);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  function MaintenancePhoto(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#maintenance_photo').attr('src',e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }	
</script>

@endpush