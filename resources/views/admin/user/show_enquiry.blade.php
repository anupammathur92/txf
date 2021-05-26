@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Enquiry</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_user') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enquiry</li>
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
                            <h5>Enquiry Details</h5>
                        </div>
                        <div class="box-row flex-wrap user-contact">
                            <div class="d-flex">
                                <label>Contact Name</label>
                                <span class="text-muted">{{ $enquiry_detail->contact_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Organizer/Business Name</label>
                                <span class="text-muted">{{ $enquiry_detail->organizer_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Email Address</label>
                                <span class="text-muted">{{ $enquiry_detail->email }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Phone Number</label>
                                <span class="text-muted">{{ $enquiry_detail->country_code.' '.$enquiry_detail->mob_no }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Address</label>
                                <span class="text-muted">{{ $enquiry_detail->address }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Event Name</label>
                                <span class="text-muted">{{ $enquiry_detail->event_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Date</label>
                                <span class="text-muted">{{ date('d-m-Y',strtotime($enquiry_detail->event_date)) }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Expected number of Guests</label>
                                <span class="text-muted">{{ $enquiry_detail->tot_guests }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Additional Details </label>
                                <span class="text-muted">{{ ucfirst($enquiry_detail->event_payment_type) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection