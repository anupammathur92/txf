@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Venue Image</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_venue') }}">Venue List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Venue Image</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_venue_image') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="venue_id" value="{{ $venue_id }}">
                    <input type="hidden" name="update_id" value="{{ $venue_image_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-sm-6" id="imageDiv">
                                <div class="form-group">
                                <label class="col-md-3 col-form-label">Image</label>
                                    <div class="upload-btn">
                                        <input id="venue_logo" type="file" name="venue_image">
                                        <label class="btn btn-primary" for="venue_logo">Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_venue_image',$venue_id) }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection