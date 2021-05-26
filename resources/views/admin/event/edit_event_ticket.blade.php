@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Edit Event</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-4 mb-4">
                    <form class="box bg-white" method="POST" action="{{ route('admin.update_event_ticket') }}">
                    @csrf
                        <input type="hidden" name="update_id" value="{{ $ticket_details->id }}">
                        <input type="hidden" name="event_id" value="{{ $ticket_details->event_id }}">
                        <div class="box-row flex-wrap">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Ticket Category</label>
                                    <div class="input-group">
                                        <select class="form-control" name="ticket_category_id">
                                            @if(!empty($ticket_categories))
                                                @foreach($ticket_categories as $ticket_category)
                                                    <option 
                                                    @if($ticket_category->id==$ticket_details->ticket_category_id)
                                                        selected
                                                    @endif
                                                    value="{{ $ticket_category->id }}">{{ $ticket_category->ticket_category_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Total Tickets</label>
                                    <div class="input-group">
                                        <input type="number" min="1" class="form-control" name="total_tickets" autocomplete="off" value="{{ $ticket_details->total_tickets }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Max. Tickets Per User</label>
                                    <div class="input-group">
                                        <input type="number" min="1" class="form-control" name="    max_ticket_per_user" autocomplete="off" value="{{ $ticket_details->max_ticket_per_user }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Per Ticket Price($)</label>
                                    <div class="input-group">
                                        <input type="number" min="1" step="0.01" class="form-control" name="per_ticket_price" autocomplete="off" value="{{ $ticket_details->per_ticket_price }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Admin Commission (%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" min="1" step="0.01" name="admin_comm" autocomplete="off" value="{{ $ticket_details->admin_comm }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-center">
                                <a href="{{ route('admin.list_event_ticket',$event_id) }}" class="btn light">Cancel</a>
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection