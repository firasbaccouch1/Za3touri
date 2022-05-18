@extends('Master_pages.Admin')
@section('style')
<style>
    .photo{
        position: relative;
  width: 200px;
  height: 200px;
        margin: auto;
    }
    .add-photo{
       
 position: absolute;
  top: 100px;
  right: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: 3px solid rgb(40, 187, 64);

      
    }
</style>
@endsection
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/app.css') }}">
<a href="{{ route('admin.dashbord') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
<div class="col-sm-12 text-center">
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-lg-12 " >
                        <div class="photo">
                        <img src="{{ asset($admin->photo) }}" id="mainThmb" style="width: 160px;height:160px;border-radius: 50%" alt="">
                        <div class="add-photo" >
                            <label style=" cursor: pointer;" for="file-upload" class="custom-file-upload">
                                <i  style="color: rgba(40, 187, 64, 0.856)" class="fas fa-plus fa-3x"></i>
                            </label>
                        </div>
                    </div>
                 
                        <br>
                      
                        <input type="file" style="visibility: hidden" id="file-upload" onChange="mainThamUrl(this)"  name='photo'>
                        </div>
                    </div>
                    
                    
            <br><br>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Name</h2>

                     <span class="dash__text"><b>{{ $admin->name }}</b></span>
                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Email</h2>

                    <span class="dash__text"><b>{{ $admin->email }}</b></span>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Role</h2>
                    @if ($admin->HasRole('owner'))
                    <span class="badge badge-pill badge-warning">Owner </span>
                    @else
                    <span class="badge badge-pill badge-info">{{ $admin->getRoleNames() }}  </span>
                    @endif
                   

                </div>
                <div class="col-lg-6 u-s-m-b-30">
                    <h2 class="u-s-m-b-8">last update</h2>
                    <span class="dash__text"><b>{{ $admin->updated_at }}</b></span>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-3" >

                </div>
                <div class="col-sm-6" >
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        update
                      </button>
                </div>
                <div class="col-sm-3" >

                </div>
            </div>
        </form>
    </div>
</div>
</div>

   

@endsection
@push('scripts')
<script type="text/javascript">
    function mainThamUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          $('#mainThmb').attr('src',e.target.result).width(160).height(160);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }	
  </script>
@endpush