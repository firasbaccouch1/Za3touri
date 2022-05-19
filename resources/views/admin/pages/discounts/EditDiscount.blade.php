@extends('Master_pages.Admin')
@section('title','Edit Discount')
@section('content')
        <div class='container'>
          <a href="{{ route('Discount.index') }}" style="margin-left: 20px" class="btn btn-secondary" ><span style="color: whitesmoke"><i class="fas fa-arrow-circle-left fa-lg"></i> Back</span></a>
            <div class="row ">
                <div class='col-sm-12 '>
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit Discount</h1>
                      </div>
                      @foreach ($errors->all() as $error)
                         <span class="text-danger">- {{ $error }}</span> <br/>
                      @endforeach 
                      <form class="user" method="POST" action="{{ route('Discount.update',$discount->id) }}" >
                        @csrf
                        @method('PATCH')
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">Discount %</span>
                            <input type="text" value="{{ $discount->discount }}" name="discount" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $discount->id }}">
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <span class="color-gray">expiry date </span>
                            <input type="date" value="{{ $discount->expired_at }}" name="expiry_date" class="form-control form-control-user"  >
                            <br>
                          </div>
                        </div>
                        <div class="form-group row text-center justify-content-center">
                          <div class="col-lg-8 ">
                            <input class="form-control-user"  {{ $discount->counter==1?'checked':'' }}  type="checkbox" value="1" style="transform: scale(1.5);" name='counter' >
                            <span class="color-gray">Counter </span>
                            <br>
                          </div>
                        </div>
                        <edit-discount></edit-discount>
                       
              
                       <br><br>
                       <div class="form-group row text-center justify-content-center">
                        <div class="col-lg-8 ">
                          <button type="submit" class="btn btn-primary btn-user btn-block">
                            Update
                          </button>
          

                            </div>
                          </div>
                        <hr>
                       
                      </form>
                </div>
            </div>
          </div>
@push('scripts')
  <script>
     window.discount = @json($discount);
  </script>
@endpush
@endsection