@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Edit Venue</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Venue</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_venue') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="update_id" value="{{ $venue_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Venue Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="venue_name" name="venue_name" autocomplete="off" value="{{ $venue_details->venue_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Logo (Max. Allowed Size: 60px x 40px)</label>
                                    <div class="upload-btn">
                                        <input id="venue_logo" type="file" name="venue_logo">
                                        <label class="btn btn-primary" for="venue_logo">Venue Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Header (Max. Allowed Size: 440px x 240px)</label>
                                    <div class="upload-btn">
                                        <input id="venue_header_image" type="file" name="venue_header_image">
                                        <label class="btn btn-primary" for="venue_header_image">Venue Header Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-6">
                                <div class="form-group">
                                    <label>Venue Address</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="venue_address" name="venue_address" placeholder='Venue Address' autocomplete="off" value="{{ $venue_details->venue_address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-6">
                                <div class="form-group">
                                    <label>Venue Address (Digital)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="digital_venue_address" placeholder='Venue Address (Digital)' autocomplete="off" value="{{ $venue_details->digital_venue_address }}">
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_venue') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection