@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Event</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Event</li>
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
                            <h5>Event</h5>
                        </div>
                        <div class="box-row flex-wrap user-contact">
                            <div class="d-flex">
                                <label>Event Name</label>
                                <span class="text-muted">{{ $event_details->event_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Venue Name</label>
                                <span class="text-muted">{{ $event_details->getVenue->venue_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Category Name</label>
                                <span class="text-muted">{{ $event_details->getCategory->category_name }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Date</label>
                                <span class="text-muted">{{ date('d-m-Y',strtotime($event_details->event_date)) }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Start & End Time</label>
                                <span class="text-muted">{{ $event_details->event_time }} - {{ $event_details->event_end_time }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Organizer (If any)</label>
                                <span class="text-muted">{{ $event_details->organizer }}</span>
                            </div>
                            <div class="d-flex">
                                <label>Artist</label>
                                <span class="text-muted">
                                    @if(!empty($event_details->getEventArtists))
                                        @foreach($event_details->getEventArtists as $artist)
                                            {{$artist->artist_name}}<br>
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                        <table  class="table mt-4 table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ticket Category Name</th>
                                    <th scope="col">Total Tickets</th>
                                    <th scope="col">Available Tickets</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($event_details->getEventTickets))
                                        @foreach($event_details->getEventTickets as $value)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$value->getTicketCategory->ticket_category_name}}</td>
                                            <td>{{$value->total_tickets}}</td>
                                            <td>{{$value->available_tickets}}</td>
                                        </tr>
                                        @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection