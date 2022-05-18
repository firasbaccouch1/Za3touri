@extends('Master_pages.Admin')
@section('content')
<a href="{{ route('Category.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row">
                <div class='col-sm-12'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Category</h1>
                      </div>
                      <form class="user" method="POST" action="{{ route('Category.store') }}">
                        @csrf
                        <div class="form-group row">
                            @error('name_en')
                                <span class='text-danger'>{{ $message }}</span>
                            @enderror
                          <div class="col-sm-12 ">
                            <input type="text" name="name_en" class="form-control form-control-user"  placeholder="Name en">
                            <br>
                          </div>
                          
                          <div class="col-sm-12">
                            @error('name_ar')
                            <span class='text-danger'>{{ $message }}</span>
                        @enderror
                            <input type="text" name="name_ar" class="form-control form-control-user"  placeholder="Name ar">
                          </div>
                        </div>
                        <div class="form-group">
                            @error('icon')
                            <span class='text-danger'>{{ $message }}</span>
                        @enderror
                          <input type="text" name="icon" class="form-control form-control-user"  placeholder="Icon (font awesome)">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                          Create
                        </button>
                        <hr>
                       
                      </form>
                </div>
            </div>
        </div>

@endsection