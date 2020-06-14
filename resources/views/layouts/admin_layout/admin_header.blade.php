<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/admin/dashboard')}}" class="nav-link">Home</a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ucwords(Auth::guard('admin')->user()->name)}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{isset(Auth::guard('admin')->user()->image) ? asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) : asset('images/admin_images/avatar2.png')}}" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{ucwords(Auth::guard('admin')->user()->name)}} - Web Developer
                        <small>Member since Nov. 2012</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <a href="{{url('admin/settings')}}"><i class="fas fa-edit" title="Password" data-toggle="tooltip" data-placement="top"></i> Password</a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="{{url('admin/update-admin-details')}}"><i class="fas fa-edit" title="Details" data-toggle="tooltip" data-placement="top"></i> Details</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat float-right">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
