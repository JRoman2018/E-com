@extends('layouts.admin_layout.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catalogues</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Banners</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Banners</h3>
                            <a href="{{url('admin/add-edit-banner')}}" class="btn btn-success float-right">Add Banner</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="sections" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th>Title</th>
                                    <th>Alt</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                <tr>
                                    <td>{{$banner['id']}}</td>
                                    <td>
                                        <img width="150px" src="{{url('/images/banner_images/'.$banner['image'])}}" alt="">
                                    </td>
                                    <td>{{$banner['link']}}</td>
                                    <td>{{$banner['title']}}</td>
                                    <td>{{$banner['alt']}}</td>
                                    <td>
                                        <a href="{{url('admin/add-edit-banner/'.$banner['id'])}}" class="mr-3" title="Edit Banner" data-toggle="tooltip" data-placement="top"><i class="far fa-edit"></i></a>
                                        <a href="javascript:void(0){{--{{url('admin/delete-brand/'.$category['id)}}--}}" class=" mr-3 confirmDelete text-danger" record="banner" recordid="{{$banner['id']}}" title="Delete Banner" data-toggle="tooltip" data-placement="top"><i class="far fa-trash-alt"></i></a>
                                        @if($banner['status'] == 1)
                                            <a class="updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" href="javascript:void(0)">
                                                <i class="fas fa-toggle-on text-success" aria-hidden="true" status="Active"></i></a>
                                        @else
                                            <a class="updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" href="javascript:void(0)">
                                                <i class="fas fa-toggle-off text-danger" aria-hidden="true" status="Inactive"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
