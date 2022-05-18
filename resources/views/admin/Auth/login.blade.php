<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Login</title>
  <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <!-- Custom fonts for this template-->
  <link href="{{ asset('backend/Adminlogin/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link async href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
 
  <!-- Custom styles for this template-->
  <link href="{{ asset('backend/Adminlogin/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
</head>

<body style="background: linear-gradient(45deg, rgb(0, 0, 0), rgb(185, 43, 150)">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row" style="background: rgb(231, 230, 230) ;">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin <i class="fas fa-lock"></i></h1>
                  </div>
                  <form method="POST" action="{{ route('admin.attempt') }}" class="user">
                    @csrf
                    <div class="form-group">
                      @error('email')
                      <span class='text-danger'>{{ $message }}</span>
                      @enderror
                      
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      @error('password')
                      <span class='text-danger'>{{ $message }}</span>
                      @enderror
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn  btn-user btn-block" style="background: linear-gradient(45deg, rgb(0, 0, 0), rgb(211, 33, 166)">login</button> 
                      if you are not admin just <a href="{{ URL('/') }}">Click here</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backend/Adminlogin/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/Adminlogin/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('backend/Adminlogin/js/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
  <script>
  @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
 
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
 
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
 
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
</script>
 @endif
</body>

</html>
