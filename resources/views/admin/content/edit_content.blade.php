@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Edit Content</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Content</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_content') }}">
                    @csrf
                        <input type="hidden" name="update_id" value="{{ $content_details->id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Title</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="title" name="title" autocomplete="off" value="{{ $content_details->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Content</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="content" name="content">{{ $content_details->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_content') }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection