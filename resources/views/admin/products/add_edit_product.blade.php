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
                                            @foreach($categories as $section)
                                                <optgroup label="{{$section['name']}}"></optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{$category['id']}}"
                                                        {{!empty(@old('category_id')) && $category['id'] == @old('category_id') ? "selected" : ""}}
                                                        {{!empty($productdata['category_id']) && $productdata['category_id'] == $category['id']  ? "selected" : ""}}
                                                    >&nbsp;&nbsp;&nbsp; &#8594; &nbsp;{{$category['category_name']}}</option>
                                                    @foreach($category['subcategories'] as $subcategory)
                                                        <option value="{{$subcategory['id']}}"
                                                            {{!empty(@old('category_id')) && $subcategory['id'] == @old('category_id') ? "selected" : ""}}
                                                            {{!empty($productdata['category_id']) && $productdata['category_id'] == $subcategory['id']  ? "selected" : ""}}>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	- &nbsp;&nbsp;{{$subcategory['category_name']}}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand['id']}}"
                                                    {{!empty(old('brand_id')) && $brand['id'] == old('brand_id') ? "selected" : ""}}
                                                    {{!empty($productdata['brand_id']) && $brand['id'] == $productdata['brand_id'] ? "selected" : ""}}>{{$brand['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" name="product_name"
                                               id="product_name" placeholder="Enter Product Name"
                                               value="{{!empty($productdata['product_name']) ? $productdata['product_name'] : (old('product_name'))}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input type="text" class="form-control" name="product_code"
                                               id="product_code" placeholder="Enter Product Code"
                                               value="{{!empty($productdata['product_code']) ? $productdata['product_code'] : (old('product_code'))}}" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_color">Product Color</label>
                                        <input type="text" class="form-control" name="product_color"
                                               id="product_color" placeholder="Enter Product Color"
                                               value="{{!empty($productdata['product_color']) ? $productdata['product_color'] : (old('product_color'))}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input type="text" class="form-control" name="product_price"
                                               id="product_price" placeholder="Enter Product Price"
                                               value="{{!empty($productdata['product_price']) ? $productdata['product_price'] : (old('product_price'))}}" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount (%)</label>
                                        <input type="text" class="form-control" name="product_discount"
                                               id="product_discount" placeholder="Enter Product Discount"
                                               value="{{!empty($productdata['product_discount']) ? $productdata['product_discount'] : (old('product_discount'))}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight</label>
                                        <input type="text" class="form-control" name="product_weight"
                                               id="product_weight" placeholder="Enter Product Weight"
                                               value="{{!empty($productdata['product_weight']) ? $productdata['product_weight'] : (old('product_weight'))}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
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
                                        @if(!empty($productdata['main_image']))
                                            <div><img style="width: 80px; margin-top: 5px;" src="{{asset('images/product_images/small/'.$productdata['main_image'])}}" alt="">
                                                &nbsp;<a href="javascript:void(0)" record="product-image" recordid="{{$productdata['id']}}"
                                                         class="confirmDelete text-danger" title="Delete Image" data-toggle="tooltip" data-placement="right"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        @endif
                                        <small>Recommended Image Size: (Width: 1040px, Height: 1200px)</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea class="form-control" rows="3" id="description"
                                                  name="description" placeholder="Enter Product Description...">{{!empty($productdata['description']) ? $productdata['description'] : (old('description'))}}</textarea>
                                    </div>

                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_video">Product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_video" name="product_video" accept="video/*">
                                                <label class="custom-file-label" for="product_video">Choose Video</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                        @if(!empty($productdata['product_video']))
                                            <div class="pt-2">
                                                <a href="{{asset('videos/product_videos/'.$productdata['product_video'])}}" download>
                                                    Download
                                                </a> &nbsp;|&nbsp;
                                                <a href="javascript:void(0)" record="product-video" recordid="{{$productdata['id']}}"
                                                   class="confirmDelete text-danger">Delete Video</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group" style="margin-top: 40px;">
                                        <label for="wash_care">Wash Care</label>
                                        <textarea class="form-control" rows="3" id="wash_care"
                                                  name="wash_care" placeholder="Enter Product Description...">{{!empty($productdata['wash_care']) ? $productdata['wash_care'] : (old('wash_care'))}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Fabric</label>
                                        <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($fabricArray as $fabric)
                                                <option value="{{$fabric}}"
                                                    {{!empty(old('fabric')) && $fabric == old('fabric') ? "selected" : ""}}
                                                    {{!empty($productdata['fabric']) && $fabric == $productdata['fabric'] ? "selected" : ""}}>{{$fabric}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Sleeve</label>
                                        <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($sleveeArray as $slevee)
                                                <option value="{{$slevee}}"
                                                    {{!empty(old('sleeve')) && $slevee == old('sleeve') ? "selected" : ""}}
                                                    {{!empty($productdata['sleeve']) && $slevee == $productdata['sleeve'] ? "selected" : ""}}>{{$slevee}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Pattern</label>
                                        <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($patternArray as $pattern)
                                                <option value="{{$pattern}}"
                                                    {{!empty(old('pattern')) && $pattern == old('pattern') ? "selected" : ""}}
                                                    {{!empty($productdata['pattern']) && $pattern == $productdata['pattern'] ? "selected" : ""}}>{{$pattern}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Fit</label>
                                        <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($fitArray as $fit)
                                                <option value="{{$fit}}"
                                                    {{!empty(old('fit')) && $fit == old('fit') ? "selected" : ""}}
                                                    {{!empty($productdata['fit']) && $fit == $productdata['fit'] ? "selected" : ""}}>{{$fit}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Select Occasion</label>
                                        <select name="occasion" id="occasion" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($ocassionArray as $occasion)
                                                <option value="{{$occasion}}"
                                                    {{!empty(old('occasion')) && $occasion == old('occasion') ? "selected" : ""}}
                                                    {{!empty($productdata['occasion']) && $occasion == $productdata['occasion'] ? "selected" : ""}}>{{$occasion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top: 63px;">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea class="form-control" rows="3" id="meta_title" name="meta_title" placeholder="Enter Meta Description...">{{!empty($productdata['meta_title']) ? $productdata['meta_title'] : (old('meta_title'))}}</textarea>
                                    </div>
                                </div>


                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" rows="3" id="meta_description" name="meta_description" placeholder="Enter Meta Description...">{{!empty($productdata['meta_description']) ? $productdata['meta_description'] : (old('meta_description'))}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea class="form-control" rows="3" id="meta_keyword" name="meta_keywords" placeholder="Enter Meta Description...">{{!empty($productdata['meta_keywords']) ? $productdata['meta_keywords'] : (old('meta_keywords'))}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="is_featured">Feature Item </label>
                                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes" {{!empty($productdata['is_featured']) && $productdata['is_featured'] == "Yes"  ? "checked" : ""}}>
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
