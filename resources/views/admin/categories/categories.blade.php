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
                        <li class="breadcrumb-item active">Categories</li>
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
                            <h3 class="card-title">Categories</h3>
                            <a href="{{url('admin/add-edit-category')}}" class="btn btn-success float-right">Add Category</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="categories" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Parent Category</th>
                                    <th>Section</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}
                                    <td>{{$category->category_name}}</td>
                                    <td>{{isset($category->parentcategory->category_name) ? $category->parentcategory->category_name : "Root"}}</td>
                                    <td>{{$category->section->name}}</td>
                                    <td>{{$category->url}}</td>
                                    <td>
                                        @if($category->status == 1)
                                            <a class="updateCategoryStatus text-success" id="category-{{$category->id}}" category_id="{{$category->id}}" href="javascript:void(0)">
                                                Active</a>
                                        @else
                                            <a class="updateCategoryStatus text-danger" id="category-{{$category->id}}" category_id="{{$category->id}}" href="javascript:void(0)">
                                                Inactive</a>
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{url('admin/add-edit-category/'.$category->id)}}" title="Edit Category" data-toggle="tooltip" data-placement="top"><i class="far fa-edit"></i></a>
                                        <a href="javascript:void(0){{--{{url('admin/delete-category/'.$category->id)}}--}}" class="confirmDelete text-danger" record="category" recordid="{{$category->id}}" title="Delete Category" data-toggle="tooltip" data-placement="top"><i class="far fa-trash-alt"></i></a>
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
