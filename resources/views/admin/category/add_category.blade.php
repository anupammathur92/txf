@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Add Category</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.store_category') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="category_name" autocomplete="off" value="{{ old('category_name') }}">
                                    </div>
                                    @if($errors->has('category_name'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('category_name')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Image (Max. Allowed Size: 100px x 100px)</label>
                                    <div class="upload-btn">
                                        <input id="category_image" type="file" name="category_image">
                                        <label class="btn btn-primary" for="category_image">Category Image</label>
                                    </div>
                                    @if($errors->has('category_image'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('category_image')}}</span>
                                   @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_category') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection