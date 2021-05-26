@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Contact Us</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_user') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <div class="box bg-white">
                        <div class="box-title pb-0">
                            <h5>Contact Us Details</h5>
                        </div>
                        <div class="box-row flex-wrap user-contact">
                            <div class="d-flex">
                                <label>Name</label>
                                <span class="text-muted">{{ $contact_us_detail->full_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Email</label>
                                <span class="text-muted">{{ $contact_us_detail->email }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Mobile No.</label>
                                <span class="text-muted">{{ $contact_us_detail->country_code.' '.$contact_us_detail->mob_no }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Subject</label>
                                <span class="text-muted">{{ $contact_us_detail->subject }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Comments</label>
                                <span class="text-muted">{{ $contact_us_detail->comments }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection