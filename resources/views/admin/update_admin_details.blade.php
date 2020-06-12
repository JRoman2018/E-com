@extends('layouts.admin_layout.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Admin Details</h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($errors->any() || Session::has('success_message'))
                            <div class="alert alert-{{$errors->any() ? 'danger' : 'success'}}" style="display:none; margin-top: 10px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                @if($errors->any())
                                    <ul class="py-0 my-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{Session::get('success_message')}}
                                @endif
                            </div>
                            <script>
                                $('.alert').slideDown();
                                setTimeout(function () {
                                    $('.alert').slideUp();
                                }, 10000)
                            </script>
                    @endif
                        <!-- form start -->
                        <form role="form" method="post" action="{{url('/admin/update-admin-details')}}" name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Email</label>
                                    <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Type</label>
                                    <input class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Name</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->name }}"
                                           placeholder="Enter Admin/Sub Admin Name" id="admin_name" name="admin_name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mobile</label>
                                    <input type="text" class="form-control" name="admin_mobile" id="admin_mobile" value="{{ Auth::guard('admin')->user()->phone }}"
                                           placeholder="Enter Admin Mobile">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="admin_image" id="admin_image" accept="image/*">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    @if(!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}">
                                            <i class="far fa-image text-success" style="font-size: 32px;" data-toggle="tooltip" data-placement="right" title="View Inage"></i>
                                        </a>
                                        <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}" >
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
