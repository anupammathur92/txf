@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Venue</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Venue</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <table id="dataTable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Logo</th>
                                            <th scope="col">Header Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($venues))
                                            @foreach($venues as $venue)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $venue->venue_name }}</td>
                                                    <td>{{ $venue->venue_address }}</td>
                                                    <td><img src="{{ asset('/public/uploads/'.$venue->venue_logo) }}" class="d-block m-auto img-fluid" hight="100px" width="100px" alt="logo"></td>
                                                    <td><img src="{{ asset('/public/uploads/'.$venue->venue_header_image) }}" class="d-block m-auto img-fluid" hight="100px" width="100px" alt="header image"></td>
                                                    <td>
                                                        <a href="{{ url('admin/update-venue-status',$venue->id) }}" class="">
                                                            @if($venue->status==0)
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @elseif($venue->status==1)
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td class="action">
                                                        <a href="{{ url('admin/show-venue',$venue->id) }}">
                                                            <button type="button" class="icon-btn preview">
                                                                <i class="fal fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/edit-venue',$venue->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <!-- <a href="{{ url('admin/list-venue-media',$venue->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-tv"></i>
                                                            </button>
                                                        </a> -->
                                                        <a title='Video' href="{{ url('admin/list-venue-video',$venue->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-play-circle"></i>
                                                            </button>
                                                        </a>
                                                        <a title='Image' href="{{ url('admin/list-venue-image',$venue->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-border-all"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/delete-venue',$venue->id) }}">
                                                            <button type="button" class="icon-btn delete">
                                                                <i class="fal fa-times"></i>
                                                            </button>
                                                        </a>
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