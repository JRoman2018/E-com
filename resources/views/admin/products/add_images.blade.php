@extends('layouts.admin_layout.admin_layout')

@push('style')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/admin/products')}}">Products</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                @if ($errors->any() || Session::has('success_message') || Session::has('error_message'))
                    <div class="alert @if($errors->any()) alert-danger @elseif(Session::has('error_message')) alert-warning @else alert-success @endif" style="display:none; margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @if($errors->any())
                            <ul class="py-0 my-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @elseif(Session::has('error_message'))
                            {{Session::get('error_message')}}
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

                <form name="addAttributeForm" id="addAttributeForm" method="post" action="{{url('admin/add-images/'.$productdata['id'])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Product Name:</label>&nbsp; {{$productdata['product_name']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code:</label>&nbsp; {{$productdata['product_code']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color:</label>&nbsp; {{$productdata['product_color']}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img style="width: 120px;" src="{{asset('images/product_images/small/'.$productdata['main_image'])}}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div>
                                                <input multiple="" id="images" type="file" name="images[]" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add Images</button>
                        </div>
                    </div>
                </form>

                <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{url('admin/edit-images/'.$productdata['id'])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Added Product Images</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="products_attribute" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productdata['images'] as $image)
                                <input type="text" name="attrId[]" value="{{$image['id']}}" hidden>
                                <tr>
                                    <td>{{$image['id']}}</td>
                                    <td>
                                        <img style="width: 120px;" src="{{asset('images/product_images/small/'.$image['image'])}}" alt="">
                                    </td>
                                    <td>
                                        @if($image['status'] == 1)
                                            <a class="mr-2 updateImageStatus text-success" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0)">Active</a>
                                        @else
                                            <a class="mr-2 updateImageStatus text-danger" id="image-{{$image['id']}}" image_id="{{$image['id']}}" href="javascript:void(0)">Inactive</a>
                                        @endif
                                        <a href="javascript:void(0)" class="confirmDelete text-danger" record="image" recordid="{{$image['id']}}" title="Delete Image" data-toggle="tooltip" data-placement="top"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update Images</button>
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
@endsection
