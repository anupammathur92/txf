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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Enquiry</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <!-- <div class="col-sm-12 mb-4">
                    <form class="box bg-white">
                        <div class="box-title pb-0">
                            <h5></h5>
                        </div>
                        <div class="d-flex flex-wrap align-items-end py-4">
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label>Position</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn w-100">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="col-sm-12 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <table id="dataTable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Contact Name</th>
                                            <th scope="col">Organizer Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($list_enquiries))
                                            @foreach($list_enquiries as $enquiry)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $enquiry->contact_name  }}</td>
                                                    <td>{{ $enquiry->organizer_name }}</td>
                                                    <td>{{ $enquiry->email }}</td>
                                                    <td class="action"><a href="{{ url('admin/show-enquiry',$enquiry->id) }}">
                                                            <button type="button" class="icon-btn preview">
                                                                <i class="fal fa-eye"></i>
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