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
                            <li class="breadcrumb-item active">Products</li>
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
                                <h3 class="card-title">Products</h3>
                                <a href="{{url('admin/add-edit-product')}}" class="btn btn-success float-right">Add Product</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Product Image</th>
                                        <th>Category</th>
                                        <th>Section</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->id}}
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->product_code}}</td>
                                            <td>{{$product->product_color}}</td>
                                            <td>
                                                @if(!empty($product->main_image) && file_exists("images/product_images/small/".$product->main_image))
                                                <img style="width: 100px"
                                                     src="{{asset('images/product_images/small/'.$product->main_image)}}" alt="">
                                                @else
                                                    <img style="width: 100px"
                                                         src="{{asset('images/product_images/small/no-image.png')}}" alt="">
                                                @endif
                                            </td>
                                            <td>{{$product->category->category_name}}</td>
                                            <td>{{$product->section->name}}</td>
                                            <td>
                                                @if($product->status == 1)
                                                    <a class="updateProductStatus text-success" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">
                                                        Active</a>
                                                @else
                                                    <a class="updateProductStatus text-danger" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:void(0)">
                                                        Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('admin/add-attributes/'.$product->id)}}" class="text-dark mr-1" title="Add/Edit Attributes" data-toggle="tooltip" data-placement="top"><i class="fas fa-plus"></i></a>
                                                <a href="{{url('admin/add-edit-product/'.$product->id)}}" class="mr-1" title="Edit Product" data-toggle="tooltip" data-placement="top"><i class="far fa-edit"></i></a>
                                                <a href="javascript:void(0){{--{{url('admin/delete-category/'.$product->id)}}--}}" class="confirmDelete text-danger" record="product" recordid="{{$product->id}}" title="Delete Product" data-toggle="tooltip" data-placement="top"><i class="far fa-trash-alt"></i></a>
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
