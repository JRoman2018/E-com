<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/dashboard')}}" class="brand-link">
        <img src="{{asset('images/admin_images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{!empty(Auth::guard('admin')->user()->image) ? asset('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) : asset('images/admin_images/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ucwords(Auth::guard('admin')->user()->name)}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class="nav-link {{Session::get('page') ==  'dashboard'? 'active' : ""}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview
                {{Session::get('page') ==  'settings' || Session::get('page') == 'update-admin-details' ? 'menu-open' : ""}}">
                    <a href="#" class="nav-link
                    {{Session::get('page') ==  'settings' || Session::get('page') == 'update-admin-details' ? 'active' : ""}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/settings')}}" class="nav-link {{Session::get('page') ==  'settings' ? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Admin Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin/update-admin-details')}}" class="nav-link {{Session::get('page') ==  'update-admin-details' ? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Admin Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                {{Session::get('page') ==  'sections' ||
                Session::get('page') ==  'categories' ||
                Session::get('page') ==  'brands' ||
                Session::get('page') ==  'banners' ||
                Session::get('page') ==  'products' ? 'menu-open' : ""}}">
                    <a href="{{url('admin/sections')}}" class="nav-link
                    {{Session::get('page') ==  'sections' ||
                    Session::get('page') ==  'categories' ||
                    Session::get('page') ==  'brands' ||
                    Session::get('page') ==  'banners' ||
                    Session::get('page') ==  'products' ? 'active' : ""}}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Catalogues
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/sections')}}" class="nav-link {{Session::get('page') ==  'sections'? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sections</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/brands')}}" class="nav-link {{Session::get('page') ==  'brands'? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/categories')}}" class="nav-link {{Session::get('page') ==  'categories'? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/products')}}" class="nav-link {{Session::get('page') ==  'products'? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/banners')}}" class="nav-link {{Session::get('page') ==  'banners'? 'active' : ""}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banners</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
