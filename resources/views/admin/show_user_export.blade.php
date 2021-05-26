@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Export</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Export</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 mb-4">
                    <form class="box bg-white" target="_blank" method="post" action="{{ route('admin.export_users') }}">
                        @csrf
                        <div class="box-title pb-0">
                            <h5>Filter</h5>
                        </div>
                        <div class="d-flex flex-wrap align-items-end py-4">
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Date</label>
                                    <input type="text" class="form-control" placeholder="Event Date Range" autocomplete="off" name="event_date_ranges" value="" />
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn">Export</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
