
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"href="{{ route('admin.dashbord') }}">
      <div class="sidebar-brand-icon rotate-n-15">
        <img src="{{ asset(settings()->logo_site) }}" style="width: 40px;"  alt="">
      </div>
      <div class="sidebar-brand-text mx-3">Za3touri <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Active_html('admin.dashbord') }}">
      <a class="nav-link" href="{{ route('admin.dashbord') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      <b style="font-size: 16px" class="badge badge-pill badge-success">SITE MANAGEMENT</b>
    </div>
     
        <!-- Category -->
        <li class="nav-item {{ Active_html('Category.index') }}" >
          <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo1">
            <i class="fas fa-archive"></i>
            <span>Category</span>
          </a>
          <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             <b><a class="collapse-item" href="{{ route('Category.index') }}">All Category</a></b> 
             <b><a class="collapse-item" href="{{ route('Category.create') }}">Create Category</a></b> 
            </div>
          </div>
        </li>
       <!-- Sliders -->
       <li class="nav-item {{ Active_html('Slider.index') }} {{ Active_html('Slider.create') }}  " >
        <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo2">
          <i class="fas fa-images"></i>
          <span>Sliders</span>
        </a>
        <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <b><a class="collapse-item" href="{{ route('Slider.index') }}">All Sliders</a></b> 
           <b><a class="collapse-item" href="{{ route('Slider.create') }}">Create Slider</a></b> 
             </div>
        </div>
      </li>
     

             <!-- Product -->
             <li class="nav-item {{ Active_html('Product.index') }} {{ Active_html('Product.create') }}  " >
              <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo3" aria-expanded="true" aria-controls="collapseTwo3">
                <i class="fab fa-product-hunt"></i>
                <span>Product</span>
              </a>
              <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <b><a class="collapse-item" href="{{ route('Product.index') }}">All Products</a></b> 
                 <b><a class="collapse-item" href="{{ route('Product.create') }}">Create Product</a></b> 
                   </div>
              </div>
            </li>
            
             <!-- discount -->
             <li class="nav-item {{ Active_html('Discount.index') }} {{ Active_html('Discount.create') }}  " >
              <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="true" aria-controls="collapseTwo6">
                <i class="fas fa-minus"></i>
                <span>Discounts</span>
              </a>
              <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <b><a class="collapse-item" href="{{ route('Discount.index') }}">All Discounts</a></b> 
                 <b><a class="collapse-item" href="{{ route('Discount.create') }}">Create Discount</a></b> 
                   </div>
              </div>
            </li>
             <!-- Coupon -->
             <li class="nav-item {{ Active_html('Coupon.index') }} {{ Active_html('Coupon.create') }}  " >
              <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo7" aria-expanded="true" aria-controls="collapseTwo7">
                <i class="fas fa-percentage"></i>
                <span>Coupon</span>
              </a>
              <div id="collapseTwo7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <b><a class="collapse-item" href="{{ route('Coupon.index') }}">All Coupons</a></b> 
                 <b><a class="collapse-item" href="{{ route('Coupon.create') }}">Create Coupon</a></b> 
                   </div>
              </div>
            </li>
            <hr class="sidebar-divider">
            
      <!-- Heading -->
    <div class="sidebar-heading">
      <b style="font-size: 16px" class="badge badge-pill badge-warning">USERS MANAGEMENT</b>
    </div> 
     <!-- Orders -->
    <li class="nav-item {{ Active_html('admin.Orders') }}">
      <a class="nav-link " href="{{ route('admin.Orders') }}">
        <i class="fas fa-box"></i>
        <span>Orders</span>
      </a>
    </li>
    <li class="nav-item {{ Active_html('admin.Users') }}">
      <a class="nav-link " href="{{ route('admin.Users') }}">
        <i class="fas fa-users"></i>
        <span>Users</span>
      </a>
    </li>
    <li class="nav-item {{ Active_html('admin.Massages') }}">
      <a class="nav-link " href="{{ route('admin.Massages') }}">
        <i class="fas fa-comment"></i>
        <span>Messages</span>
      </a>
    </li> 
    <li class="nav-item {{ Active_html('admin.Feedback') }}">
      <a class="nav-link " href="{{ route('admin.Feedback') }}">
        <i class="fas fa-comment-alt"></i>
        <span>Feedbacks</span>
      </a>
    </li>

        


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      <b style="font-size: 16px" class="badge badge-pill badge-danger">Admin Panal</b>
    </div>
          <!-- Admins -->
          <li class="nav-item {{ Active_html('Admins.index') }} {{ Active_html('Admins.create') }}  " >
            <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="true" aria-controls="collapseTwo4">
              <i class="fas fa-users"></i>
              <span>Admins</span>
            </a>
            <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <b><a class="collapse-item" href="{{ route('Admins.index') }}">All Admins</a></b> 
               <b><a class="collapse-item" href="{{ route('Admins.create') }}">Create Admin</a></b> 
                 </div>
            </div>
          </li>
              <!-- Roles -->
          <li class="nav-item {{ Active_html('Roles.index') }} {{ Active_html('Roles.create') }}  " >
            <a class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="true" aria-controls="collapseTwo5">
              <i class="fas fa-tools"></i>
              <span>Roles</span>
            </a>
            <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <b><a class="collapse-item" href="{{ route('Roles.index') }}">All Roles</a></b> 
               <b><a class="collapse-item" href="{{ route('Roles.create') }}">Create Role</a></b> 
                 </div>
            </div>
          </li>
    <!-- trash -->
    <li class="nav-item  {{ Active_html('Trash') }}">
      <a class="nav-link " href="{{ route('Trash') }}" >
        <i class="fas fa-trash-alt"></i>
        <span>Trash</span>
      </a>
    </li>
    <!-- site settings -->
    <li class="nav-item {{ Active_html('Settings.index') }}">
      <a class="nav-link " href="{{ route('Settings.index') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Site Settings</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="{{ route('Cache-Clear') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Clear Cache</span>
      </a>
    </li>


  </ul>