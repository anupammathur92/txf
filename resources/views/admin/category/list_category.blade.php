@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Category</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <!-- <div class="col-sm-12 mb-4">
                    <form class="box bg-white">
                        <div class="box-title pb-0">
                            <h5></h5>
                        </div>
                        <div class="d-flex flex-wrap align-items-end py-4">
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Category Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn w-100">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="col-sm-12 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <table id="dataTable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Category Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($categories))
                                            @foreach($categories as $category)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td><img src="{{ asset('/public/uploads/'.$category->category_image) }}" class="d-block m-auto img-fluid" hight="100px" width="100px" alt="category image"></td>
                                                    <td>
                                                        <a href="{{ url('admin/update-category-status',$category->id) }}" class="">
                                                            @if($category->status==0)
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @elseif($category->status==1)
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td class="action">
                                                        <a href="{{ url('admin/show-category',$category->id) }}">
                                                            <button type="button" class="icon-btn preview">
                                                            <i class="fal fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/edit-category',$category->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                            <i class="fal fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/delete-category',$category->id) }}">
                                                        <button type="button" class="icon-btn delete">
                                                            <i class="fal fa-times"></i>
                                                        </button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection