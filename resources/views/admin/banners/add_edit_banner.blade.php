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
                        <li class="breadcrumb-item"><a href="{{url('/admin/brands')}}">Banner</a></li>
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
            <form action="{{empty($banner['id']) ?
                   url('admin/add-edit-banner') :
                   url('admin/add-edit-banner/'.$banner['id'])}}"
                  name="brandForm" id="brandForm" method="post" enctype="multipart/form-data">
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
                                    <label for="main_image">Banner Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                    @if(!empty($banner['image']))
                                        <div>
                                            <img style="width: 220px; margin-top: 5px;" src="{{asset('images/banner_images/'.$banner['image'])}}" alt="">
                                        </div>
                                    @endif
                                    <small>Recommended Image Size: (Width: 1170px, Height: 480px)</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="banner_title">Banner Title</label>
                                    <input type="text" class="form-control" name="title"
                                           id="title" placeholder="Enter Banner Title"
                                           value="{{!empty($banner['id']) ? $banner['title'] : (old('title'))}}" >
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="banner_link">Banner Link</label>
                                    <input type="text" class="form-control" name="link"
                                           id="link" placeholder="Enter Banner Link"
                                           value="{{!empty($banner['id']) ? $banner['link'] : (old('link'))}}" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="banner_title">Banner Alternate Text</label>
                                    <input type="text" class="form-control" name="alt"
                                           id="alt" placeholder="Enter Banner Alternative"
                                           value="{{!empty($banner['id']) ? $banner['alt'] : (old('alt'))}}" >
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-{{$title=="Add Banner" ? 'primary' : 'success'}}">
                            {{$title=="Add Banner" ? "Submit" : "Update"}}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
