<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{ asset(settings()->logo_top) }}">
  <title>@yield('title')</title>
  <!-- Custom fonts for this template-->
  <link  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" >
  <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <script  src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
  <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   <!-- yajra fontawsome-->
   <link  rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.bootstrap4.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<!--yajra style scerch -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<!-- yajra datatables-->
<script defer src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<!--yajra button -->

 <!-- sweetalert-->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!--toast-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="{{ asset('js/backend/app.js') }}" defer></script>
<style>
    .showrows{
   background-color: rgb(170, 48, 164);
  }
</style>
@yield('style')
@stack('scripts')
</head>

<body id="page-top">
    <!-- start of vue -->
  <div id="vue">
  <!-- Page Wrapper -->
  <div id="wrapper">




  
    <!-- Sidebar -->
  @include('admin.layout.Sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column bg-gray-200">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
     @include('admin.layout.Header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
	  	@yield('content')
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
	  @include('admin.layout.Footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
</div>
  <!-- End of vue -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- toastr -->
    <script  src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>
 
  @if(Session::has('message'))
  <script>
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
 <script defer src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<!-- yajra boutons-->
<script defer src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap4.min.js"></script>
<script>
  
  $(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).parent("form");
 
  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed ) { 
                     link.submit();
                    }
                  }) 
 
 
    });
 
  });
  
  </script>
  <script type="text/javascript">
    function handleSelect(elm)
    {
       window.location = elm.value;
    }
  </script>
  
</body>
</html>
