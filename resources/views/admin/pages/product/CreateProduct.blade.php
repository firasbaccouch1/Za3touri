@extends('Master_pages.Admin')
@section('title','Create Product')
@section('style')
<style>
  .thumb{
    padding: 10px;
    border-radius: 50px;
  }
</style>
@endsection
@section('content')
<a href="{{ route('Product.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row">
                <div class='col-sm-12'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Product</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Product.store') }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row text-center">
                           
                          <div class="col-sm-6 ">
                            <span class="color-gray">Product name en english</span>
                            <input type="text" name="name_en" class="form-control form-control-user"  >
                            <br>
                          </div>
                          
                          <div class="col-sm-6">
                            <span>Product name en arabic</span>
                            <input type="text" name="name_ar" class="form-control form-control-user"  >
                          </div>
                        </div>
                        <div class="form-group row text-center">
                           
                          <div class="col-sm-6 ">
                            <span>Product discription en english</span>
                            <textarea type="text" name="discription_en" class="form-control form-control-user"  ></textarea>
                            <br>
                          </div>
                          
                          <div class="col-sm-6">
                            <span>Product discription en arabic</span>
                            <textarea type="text" name="discription_ar" class="form-control form-control-user"  ></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                         
                        <div class="col-sm-6 ">
                          <span>Product price</span>
                          <input type="text" name="price" class="form-control form-control-user"  >
                          <br>
                        </div>
                        
                        <div class="col-sm-6">
                          <span>Product qantite</span>
                          <input type="text" name="qantite" class="form-control form-control-user"  >
                        </div>
                      </div>
                      <div class="row text-center">
                        <div class="col-sm-5">
                          <span>Product Category</span>
                        <select name="category" class="form-control" style="padding: 0.3rem 0.75rem;border-radius: 50px; ">
                          <option selected disabled ><b> chose one... </b></option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> <b>{{ $category->name }}</b></option>
                            @endforeach
                        </select>
                      </div>
                        <div class=" col-sm-4">
                         <span>Product thanmile</span>
                      <input type="file" name="thumbnail" class=" form-control " onChange="mainThamUrl(this)" style="padding: 0.3rem 0.75rem;border-radius: 50px;">
                      </div>
                      <div class="col-sm-3">
                      <img src="" id="mainThmb" style="border-radius: 10rem;margin-top: -20px;" class='text-center'>
                    </div>
                      </div> 

                      <div class="row text-center">
                        <div class="col-sm-9">
                          <span>Product sub images</span>
                          <input type="file" name="images[]" class=" form-control "  multiple="" id="multiImg"  style="border-radius: 50px;" >
                        </div>
                        <div class="col-sm-3" id="preview_img">

                        </div>
  
                      </div>
                     
                       
              
                       <br><br>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                          Create
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
<script type="text/javascript">

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
          if(data != null){
            $("#remove").each(function(){
                $('#preview_img').empty();
            }); 
          }
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('id','remove').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>
  
@endpush