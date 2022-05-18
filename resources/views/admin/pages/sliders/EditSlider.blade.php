@extends('Master_pages.Admin')
@section('title','Update Slider')
@section('content')
@php
  $route = Route::current()->getName(); 
  
@endphp
<a href="{{$route == 'Slider.edit'? route('Slider.index'):route('Trash'); }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row">
                <div class='col-sm-12'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Update Slider</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Slider.update',$slider->id) }}" enctype="multipart/form-data" >
                        @csrf
                        @method('PATCH')
                        <div class="form-group row text-center">
                           
                          <div class="col-sm-6 ">
                            <input type="text" name="title_en" value="{{ $slider->title_en }}" class="form-control form-control-user"  placeholder="title en english">
                            <br>
                          </div>
                          
                          <div class="col-sm-6">
                           
                            <input type="text" name="title_ar" value="{{ $slider->title_en }}" class="form-control form-control-user"  placeholder="title en arabic">
                          </div>
                        </div>
                        <div class="form-group row">
                         
                        <div class="col-sm-6 ">
                          <input type="text" name="short_description_en" value="{{ $slider->short_description_en }}" class="form-control form-control-user"  placeholder="short description en english">
                          <br>
                        </div>
                        
                        <div class="col-sm-6">
                        
                          <input type="text" name="short_description_ar" value="{{ $slider->short_description_ar }}" class="form-control form-control-user"  placeholder="short description en arabic">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">
                           
                        <select name="category" class="form-control" style="padding: 0.3rem 0.75rem;border-radius: 50px; ">
                            @foreach ($categories as $category)
                            <option {{$category->id == $slider->category_id?'selected':'' }} value="{{ $category->id }}"> <b>{{ $category->name }}</b></option>
                            @endforeach
                        </select>
                      </div>
                        <div class=" col-sm-4">
                         <input type="hidden" name="old_photo" value="{{ $slider->photo }}">
                      <input type="file" name="photo" class=" form-control " onChange="mainThamUrl(this)" style="padding: 0.3rem 0.75rem;border-radius: 50px;" value="photo">
                      </div>
                      <div class="col-sm-3">
                      <img src="{{ asset($slider->photo) }}" style="width: 80px;height:80px;border-radius: 10rem;margin-top: -20px;" id="mainThmb"  class='text-center'>
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
  function mainThamUrl(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#mainThmb').attr('src',e.target.result).width(80).height(80);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }	
</script>
@endpush