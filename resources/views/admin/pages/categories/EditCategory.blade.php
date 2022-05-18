@extends('Master_pages.Admin')
@section('content')
@php
  $route = Route::current()->getName(); 
  
@endphp
<a href="{{ $route == 'Category.edit'? route(Category.index):route('Trash'); }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
        <div class='container'>
            <div class="row">
                <div class='col-9'>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create Category</h1>
                      </div>
                      <form class="user" method="post" action="{{ route('Category.update',$category->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            @error('name_en')
                                <span class='text-danger'>{{ $message }}</span>
                            @enderror
                          <div class="col-sm-12 ">
                            <input type="text" name="name_en" value="{{ $category->name_en }}" class="form-control form-control-user"  placeholder="Name en">
                            <br>
                          </div>
                          
                          <div class="col-sm-12">
                            @error('name_ar')
                            <span class='text-danger'>{{ $message }}</span>
                        @enderror
                            <input type="text" name="name_ar" value="{{  $category->name_ar }}" class="form-control form-control-user"  placeholder="Name ar">
                          </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-10">
                            @error('icon')
                            <span class='text-danger'>{{ $message }}</span>
                        @enderror
                          <input type="text" name="icon" value="{{  $category->icon }}" class="form-control form-control-user"  placeholder="Icon (font awesome)">
                
                        </div>
                        <div class="col-md-2">
                          <span class="text-center" ><i class="{!! $category->icon !!} fa-3x"></i></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                          Update
                        </button>
                        <hr>
                      </div>
                      </form>
                </div>
            </div>
        </div>

@endsection