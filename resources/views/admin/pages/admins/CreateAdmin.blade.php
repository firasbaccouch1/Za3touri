@extends('Master_pages.Admin')
@section('title','Create Admin')
@section('style')
<style>
  select option:checked{
   background: #1aab8e -webkit-linear-gradient(bottom, #1aab8e 0%, #1aab8e 100%);
 }
   </style>
@endsection
@section('content')
        <div class='container'>
          <a href="{{ route('Admins.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
            <div class="row ">
                <div class='col-sm-12 '>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Admin</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Admins.store') }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Admin Name</span>
                            <input type="text" name="name" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Admin Email</span>
                            <input type="text" name="email" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-4 ">
                            <span class="color-gray">Password</span>
                            <input type="password" name="password" class="form-control form-control-user"  >
                            <br>
                          </div>
                          <div class="col-lg-4 ">
                            <span class="color-gray">Confirm Password</span>
                            <input type="password" name="password_confirmation" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Chose Roles <span class="badge badge-info">you can have multiple roles</span></span><br><span class="badge badge--processing">Only Za3touri Can make  <span  class="badge badge-pill badge-warning"  >Owners</span></span>
                            <select name="roles[]" class="form-control form-control-user text-center" multiple style="border-radius: 50px;height: 90px">
                              @foreach ($roles as $role)
                              <option  value="{{ $role->name }}"class="badge badge-pill badge-{{ $role->name == 'owner'?'warning':'secondary' }}" style="padding: 10px"> <span >{{ $role->name }} </span></option>
        
                                
                              @endforeach
                    </select>
                            <br>
                          </div>
                        </div>
                       
              
                       <br><br>
                       <div class="form-group row text-center justify-content-center">
                        <div class="col-lg-8 ">
                          <button type="submit" class="btn btn-primary btn-user btn-block">
                            Create
                          </button>
          

                            </div>
                          </div>
                        <hr>
                       
                      </form>
                </div>
            </div>
          </div>
        
@endsection