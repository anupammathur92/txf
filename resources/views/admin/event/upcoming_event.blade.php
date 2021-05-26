@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Upcoming Event</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Upcoming Event</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <table id="dataTable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Is Featured</th>
                                            <th scope="col">Ticket Category</th>
                                            <th scope="col" class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($upcomingindex_event))
                                            @foreach($upcomingindex_event as $event)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $event->event_name }}</td>
                                                    <td>{{ $event->description }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/update-event-status',$event->id) }}" class="">
                                                            @if($event->status==0)
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @elseif($event->status==1)
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/update-event-featured-status',$event->id) }}" class="">
                                                            @if($event->is_featured==0)
                                                                <span class="badge badge-warning">Not Featured</span>
                                                            @elseif($event->is_featured==1)
                                                                <span class="badge badge-success">Featured</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/list-event-ticket',$event->id) }}" class="">
                                                            @if(!$event->getEventTickets->isEmpty())
                                                                <span class="badge badge-primary">Add</span>
                                                            @else
                                                                <span class="badge badge-danger">Add</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td class="action">
                                                        <a href="{{ url('admin/show-event',$event->id) }}">
                                                            <button type="button" class="icon-btn preview">
                                                                <i class="fal fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/edit-event',$event->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <!-- <a title='Ticket Categories' href="{{ url('admin/list-event-ticket',$event->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-tv"></i>
                                                            </button>
                                                        </a> -->
                                                        <a href="{{ url('admin/delete-event',$event->id) }}">
                                                            <button type="button" class="icon-btn delete">
                                                                <i class="fal fa-times"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection