@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Venue Media</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_venue') }}">Venue List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Venue Media</li>
                        </ol>
                    </nav>
                    <a href="{{ route('admin.create_venue_media',$venue_id) }}" class="btn btn-primary " style="float:right;">Add Media</a>
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
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Position</label>
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
                                            <th scope="col">Media Type</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Video Embed Code</th>
                                            <th scope="col" class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($venue_medias))
                                            @foreach($venue_medias as $venue_media)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $venue_media->media_type }}</td>
                                                    <td>{{ $venue_media->media_type }}</td>
                                                    <td>{{ $venue_media->video_embed_code }}</td>
                                                    <td class="action">
                                                        <a href="{{ url('admin/show-venue',$venue_media->id) }}">
                                                            <button type="button" class="icon-btn preview">
                                                                <i class="fal fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/edit-venue-media/'.$venue_id.'/'.$venue_media->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/delete-venue-media/'.$venue_id.'/'.$venue_media->id) }}">
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