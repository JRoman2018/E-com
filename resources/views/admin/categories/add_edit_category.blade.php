@extends('layouts.admin_layout.admin_layout')

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
                        <li class="breadcrumb-item"><a href="{{url('/admin/categories')}}">Categories</a></li>
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
            <form action="{{empty($categorydata['id']) ?
                   url('admin/add-edit-category') :
                   url('admin/add-edit-category/'.$categorydata['id'])}}"
                  name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data">
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
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" name="category_name"
                                           id="category_name" placeholder="Enter Category Name"
                                    value="{{!empty($categorydata['id']) ? $categorydata['category_name'] : (old('category_name'))}}" >
                                </div>
                                <div id="appendCategoriesLevel">
                                    @include('admin.categories.append_categories_level')
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Section</label>
                                    <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select</option>
                                        @foreach($getSections as $section)
                                            <option value="{{$section->id}}" {{!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id ? "selected" : ""}}>{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="category_image" name="category_image" accept="image/*">
                                            <label class="custom-file-label" for="category_image">Choose file</label>
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
                                    <label for="category_discount">Category Discount</label>
                                    <input type="text" class="form-control" id="category_discount"
                                           name="category_discount" placeholder="Enter Category Name"
                                           value="{{!empty($categorydata['id']) ? $categorydata['category_discount'] : (old('category_discount'))}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Category Description</label>
                                    <textarea class="form-control" rows="3" id="description"
                                              name="description" placeholder="Enter Category Description...">{{!empty($categorydata['id']) ? $categorydata['description'] : (old('description'))}}</textarea>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="url">Category URL</label>
                                    <input type="text" class="form-control" id="url"
                                           name="url" placeholder="Enter Category Name"
                                           value="{{!empty($categorydata['id']) ? $categorydata['url'] : (old('url'))}}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <textarea class="form-control" rows="3" id="meta_title" name="meta_title" placeholder="Enter Meta Description...">{{!empty($categorydata['id']) ? $categorydata['meta_title'] : (old('meta_title'))}}</textarea>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" rows="3" id="meta_description" name="meta_description" placeholder="Enter Meta Description...">{{!empty($categorydata['id']) ? $categorydata['meta_description'] : (old('meta_description'))}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <textarea class="form-control" rows="3" id="meta_keyword" name="meta_keywords" placeholder="Enter Meta Description...">{{!empty($categorydata['id']) ? $categorydata['meta_keywords'] : (old('meta_keywords'))}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{$title=="Add Category" ? "Submit" : "Update"}}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
