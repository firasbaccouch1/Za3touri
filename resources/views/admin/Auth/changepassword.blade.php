@extends('Master_pages.Admin')
@section('content')
<a href="{{ route('admin.dashbord') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row text-center">
                <div class='col-lg-12'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                      </div>
                      <form class="user" method="post" action="{{ route('admin.password.update') }}">
                        @csrf
                        @foreach ($errors->all() as $error)
                        <span class="text-danger">- {{ $error }}</span> <br/>
                     @endforeach 
                        <div class="row center">
                          <div class="col-lg-12 text-center">
                              <span class="color-gray">Current Password</span>
                            <input type="text" name="current_password" class="form-control form-control-user"  >
                          
                        </div>
                          </div>
                          <div class="row">
                          <div class="col-sm-12 text-center">
                        <span class="color-gray text-center">New Password</span>
                            <input type="text" name="password" class="form-control form-control-user" >
                          </div>
                        </div>
                        
                        <div class="row ">
                        <div class=" col-sm-12 text-center">

                        <span class="color-gray">Confirm Password</span>
                          <input type="text" name="password_confirmation"  class="form-control form-control-user"  >
                
                        <br><br>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                          Update
                        </button>
                    </div>
                        <hr>
                      </div>
                      </form>
                </div>
            </div>
        </div>

@endsection