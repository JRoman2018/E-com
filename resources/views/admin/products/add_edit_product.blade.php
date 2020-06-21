@extends('layouts.admin_layout.admin_layout')
A
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
                <form action="{{empty($productdata['id']) ?
                   url('admin/add-edit-product') :
                   url('admin/add-edit-product/'.$productdata['id'])}}"
                      name="productForm" id="productForm" method="post" enctype="multipart/form-data">
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
                                        <label>Select Category</label>
                                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" name="product_name"
                                               id="product_name" placeholder="Enter Product Name"
                                               value="{{!empty($productdata['id']) ? $productdata['product_name'] : (old('product_name'))}}" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input type="text" class="form-control" name="product_code"
                                               id="product_code" placeholder="Enter Product Code"
                                               value="{{!empty($productdata['id']) ? $productdata['product_code'] : (old('product_code'))}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input type="text" class="form-control" name="product_color"
                                               id="product_color" placeholder="Enter Product Color"
                                               value="{{!empty($productdata['id']) ? $productdata['product_color'] : (old('product_color'))}}" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input type="text" class="form-control" name="product_price"
                                               id="product_price" placeholder="Enter Product Price"
                                               value="{{!empty($productdata['id']) ? $productdata['product_price'] : (old('product_price'))}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount (%)</label>
                                        <input type="text" class="form-control" name="product_discount"
                                               id="product_discount" placeholder="Enter Product Discount"
                                               value="{{!empty($productdata['id']) ? $productdata['product_discount'] : (old('product_discount'))}}" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" name="product_weight"
                                               id="product_weight" placeholder="Enter Product Weight"
                                               value="{{!empty($productdata['id']) ? $productdata['product_weight'] : (old('product_weight'))}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="main_image">Product Main Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="main_image" name="main_image" accept="image/*">
                                                <label class="custom-file-label" for="main_image">Choose Image</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_video">Product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_video" name="product_video" accept="image/*">
                                                <label class="custom-file-label" for="product_video">Choose Image</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea class="form-control" rows="3" id="description"
                                          name="description" placeholder="Enter Product Description...">{{!empty($productdata['id']) ? $productdata['description'] : (old('description'))}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="wash_care">Wash Care</label>
                                        <textarea class="form-control" rows="3" id="wash_care"
                                                  name="wash_care" placeholder="Enter Product Description...">{{!empty($productdata['id']) ? $productdata['wash_care'] : (old('wash_care'))}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea class="form-control" rows="3" id="meta_title" name="meta_title" placeholder="Enter Meta Description...">{{!empty($productdata['id']) ? $productdata['meta_title'] : (old('meta_title'))}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" rows="3" id="meta_description" name="meta_description" placeholder="Enter Meta Description...">{{!empty($productdata['id']) ? $productdata['meta_description'] : (old('meta_description'))}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea class="form-control" rows="3" id="meta_keyword" name="meta_keywords" placeholder="Enter Meta Description...">{{!empty($productdata['id']) ? $productdata['meta_keywords'] : (old('meta_keywords'))}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-{{$title=="Add Product" ? 'primary' : 'success'}}">
                                {{$title=="Add Product" ? "Submit" : "Update"}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
