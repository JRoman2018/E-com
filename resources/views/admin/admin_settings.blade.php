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
                            <h3 class="card-title">Update Password</h3>
                        </div>
                        <!-- /.card-header -->
                        @if(Session::has('error_message') || Session::has('success_message'))
                            <div class="alert alert-{{Session::has('error_message') ? 'danger' : 'success'}}" style="display:none; margin-top: 10px">
                                {{Session::has('error_message') ? Session::get('error_message') : Session::get('success_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <script>
                                    $('.alert').slideDown();
                                    setTimeout(function () {
                                        $('.alert').slideUp();
                                    }, 10000)
                                </script>
                            </div>
                        @endif
                        <!-- form start -->
                        <form role="form" method="post" action="{{url('/admin/update-current-pwd')}}" name="updatePasswordForm" id="updatePasswordForm">
                            @csrf
                            <div class="card-body">
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Admin Name</label>
                                    <input type="text" class="form-control" value="{{ $adminDetail->name }}"
                                           placeholder="Enter Admin/Sub Admin Name" id="admin_name" name="admin_name">
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Email</label>
                                    <input class="form-control" value="{{ $adminDetail->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Admin Type</label>
                                    <input class="form-control" value="{{ $adminDetail->type }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Current Password</label>
                                    <input type="password" class="form-control" name="current_pwd" id="current_pwd" placeholder="Enter Current Password" required>
                                    <span id="chkCurrentPwd"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">New Password</label>
                                    <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm New Password" required>
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
