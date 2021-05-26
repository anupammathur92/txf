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
                            <li class="breadcrumb-item active" aria-current="page">Venue Media</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.store_venue_media') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="venue_id" value="{{ $venue_id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="gender">Media Type</label>
                                    <div class="form-check form-check-inline form-check-sm mr-2">
                                        <input class="form-check-input required" type="radio" id="video" value="video" name="media_type" checked="checked">
                                        <label class="form-check-label" for="video">Video</label>
                                    </div>
                                    <div class="form-check form-check-inline form-check-sm mr-2">
                                        <input class="form-check-input required" type="radio" id="image" value="image" name="media_type">
                                        <label class="form-check-label" for="image">Image</label>
                                    </div>
                                    <p class="redio-error ret"></p>
                                </div>
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="col-md-6 mb-3" id="videoDiv">
                                <div class="form-group">
                                    <label>Embed Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="video_embed_code" name="video_embed_code" autocomplete="off" value="{{ old('video_embed_code') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" id="imageDiv" style="display:none;">
                                <div class="form-group">
                                <label class="col-md-3 col-form-label">Image</label>
                                    <div class="upload-btn">
                                        <input id="venue_logo" type="file" name="venue_logo">
                                        <label class="btn btn-primary" for="venue_logo">Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_venue_media',$venue_id) }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection