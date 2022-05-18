@extends('Master_pages.Admin')
@section('title','Create Discount')
@section('content')
        <div class='container'>
          <a href="{{ route('Discount.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
            <div class="row ">
                <div class='col-sm-12 '>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Discount</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Discount.store') }}" >
                        @csrf
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Discount %</span>
                            <input type="text" name="discount" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">expiry date </span>
                            <input type="date" name="expiry_date" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <input class="form-control-user"  type="checkbox" value="1" style="transform: scale(1.5);" name='counter' >
                            <span class="color-gray">Counter </span>
                            <br>
                          </div>
                        </div>
                        <discount></discount>
                       
              
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