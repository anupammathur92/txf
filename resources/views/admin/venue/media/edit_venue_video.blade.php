@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Venue Video</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_venue') }}">Venue List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Venue Video</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_venue_video') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="venue_id" value="{{ $venue_id }}">
                    <input type="hidden" name="update_id" value="{{ $venue_video_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Embed Code</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="video_embed_code" name="video_embed_code" autocomplete="off" value="{{ $venue_video_details->video_embed_code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_venue_video',$venue_id) }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection