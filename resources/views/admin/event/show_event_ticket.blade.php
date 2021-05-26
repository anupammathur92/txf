@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Event Ticket</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.list_content') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Event Ticket</li>
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
                            <h5>Event Ticket Details</h5>
                        </div>
                        <div class="box-row flex-wrap user-contact">
                            <div class="d-flex">
                                <label>Ticket Category Name</label>
                                <span class="text-muted">{{ $event_ticket_details->getTicketCategory->ticket_category_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Event Name</label>
                                <span class="text-muted">{{ $event_ticket_details->getEventDetail->event_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Total Tickets</label>
                                <span class="text-muted">{{ $event_ticket_details->total_tickets }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Max. Tickets Per User</label>
                                <span class="text-muted">{{ $event_ticket_details->max_ticket_per_user }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Price Per Ticket($)</label>
                                <span class="text-muted">{{ $event_ticket_details->per_ticket_price }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Admin Comm. (%)</label>
                                <span class="text-muted">{{ $event_ticket_details->admin_comm }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection