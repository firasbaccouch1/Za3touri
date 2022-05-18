@extends('Master_pages.Admin')
@section('title','Create Role')
@section('style')
<style>
  select option:checked{
   background: #1aab8e -webkit-linear-gradient(bottom, #1aab8e 0%, #1aab8e 100%);
 }
   </style>
@endsection
@section('content')
  <a href="{{ route('Roles.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row">
              
                <div class='col-sm-12'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create role</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Roles.store') }}"  >
                        @csrf
                        
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Role Name</span>
                            <input type="text" name="name" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                      
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8">
                            <span class="color-gray">Chose Guard</span>
                            <select name="guard_name" class="form-control text-center" style="padding: 0.3rem 0.75rem;border-radius: 50px; ">
                                <option value="admin"> <b>Admin</b></option>
                                <option value="web"> <b>web</b></option>
                            </select>
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Chose Permission</span>
                            <select name="permissions[]" class="form-control form-control-user text-center" multiple style="border-radius: 50px;height: 90px">
                                      @foreach ($permissions as $permission)
                                      <option  class="badge badge-pill badge-{{ $permission->name == 'owner'?'warning':'secondary' }}" style="padding: 10px"  value="{{ $permission->id }}"> <span >{{ $permission->name }} </span></option>
                
                                        
                                      @endforeach
                            </select>
                            <br>
                          </div>
                          <br><br>
                          
                        </div>
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