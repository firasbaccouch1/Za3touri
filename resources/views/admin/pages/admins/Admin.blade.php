@extends('Master_pages.Admin')
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/app.css') }}">
<div class="col-sm-12 text-center">
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <img src="{{ asset($product->thumbnail) }}" style="width: 80px;height:100px;"  alt="">
            <br><br>
            <div class="row">
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Name</h2>

                     <span class="dash__text"><b>{{ $product->name_en }}</b></span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Slug</h2>

                    <span class="dash__text"><b>{{ $product->slug }}</b></span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Status</h2>
                    @if ($product->status == 1 ) 
                    <span class="badge badge-pill badge-success">Active</span>
                    @else
                        <span class="badge badge-pill badge-danger">inActive</span>
                    
                    @endif
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Price</h2>

                     <span class=" badge badge-pill badge-primary">{{ $product->price }}</span>
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Qantite</h2>
                    @if ($product->qantite >= 5 ) 
                    <span class="badge badge-pill badge-warning">{{ $product->qantite }} items</span>
                    @elseif ($product->qantite <= 5 )
                        <span class="badge badge-pill badge-danger">{{ $product->qantite }} items</span>
                    @else
                    <span class="badge badge-pill badge-success">{{ $product->qantite }} items</span>
                    @endif
                   

                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class="u-s-m-b-8">Category</h2>
                    <span class="dash__text"><b>{{ $product->category->name_en }}</b>--<i class="{{ $product->category->icon }} fa-lg"></i></span>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">review_status</h2>

                    @if ($product->review_status == NULL ) 
                    <span class="badge badge-pill badge-danger"> <b>No Reviews</b></span>
                    @else
                        <span class="badge badge-pill badge-danger"> testsssssssssssss</span>
                    
                    @endif
                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8" >Discount</h2>
                    @if ($product->discont_status == NULL ) 
                    <span class="badge badge-pill badge-danger">No Discount</span>
                    @else
                        <span class="badge badge-pill badge-success">tesssssssssst</span>
                    
                    @endif

                </div>
                <div class="col-lg-4 u-s-m-b-30">
                    <h2 class=" u-s-m-b-8">Last Update </h2>
                    <span class="dash__text"><b>{{ $product->updated_at }}</b></span>
                </div>
            </div>
            <br><br>
            <hr>
            <h2 class=" u-s-m-b-8">More Images</h2>
            <br><br>
            <div class="row">
                @isset($product->multi_img)
                @foreach ($product->multi_img as $images)
                <div class="col-lg-3 u-s-m-b-30">  
                    <img src="{{asset($images->images) }}" style="width: 60px" alt="">
                </div>  
                @endforeach 
                @endisset
      
            </div>
            


 
        <div class="dash__pad-2">
            <hr>
            <h1 class="dash__h1 u-s-m-b-14">Description</h1>
          <b>{{ $product->discription_en }}</b>
            

    </div>
</div>
</div>
</div>
@endsection