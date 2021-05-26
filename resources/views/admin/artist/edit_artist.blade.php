@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Edit Artist</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Artist</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_artist') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="update_id" value="{{ $artist_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Artist Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="artist_name" name="artist_name" autocomplete="off" value="{{ $artist_details->artist_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Genre</label>
                                    <div class="upload-btn">
                                        <select class="form-control" name="genre_id">
                                            @if(!empty($genres))
                                                @foreach($genres as $genre)
                                                    <option
                                                    @if($genre->id==$artist_details->genre_id)
                                                        selected
                                                    @endif
                                                     value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Image (Max. Allowed Size: 308px x 308px)</label>
                                    <div class="upload-btn">
                                        <input id="artist_image" type="file" name="artist_image">
                                        <label class="btn btn-primary" for="artist_image">Artist Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-6">
                                <div class="form-group">
                                    <label>Artist Bio</label>
                                    <div class="input-group">
                                        <textarea class="form-control" name="artist_bio">{{ $artist_details->artist_bio }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_artist') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection