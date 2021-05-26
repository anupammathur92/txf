@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Artist</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Artist</li>
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
                                            <th scope="col">Bio</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($artists))
                                            @foreach($artists as $artist)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $artist->artist_name }}</td>
                                                    <td>{{ $artist->artist_bio }}</td>
                                                    <td><img src="{{ asset('/public/uploads/'.$artist->artist_image) }}" class="d-block m-auto img-fluid" hight="100px" width="100px" alt="header image"></td>
                                                    <td>
                                                        <a href="{{ url('admin/update-artist-status',$artist->id) }}" class="">
                                                            @if($artist->status==0)
                                                                <span class="badge badge-warning">Inactive</span>
                                                            @elseif($artist->status==1)
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </a>
                                                        <select onchange="setArtistPopularity('{{ $artist->id }}',this.value)">
                                                            <option>Popularity</option>
                                                            @for ($i = 1; $i <= 8; $i++)
                                                                <option 
                                                                @if($i==$artist->popularity_sequence)
                                                                    selected
                                                                @endif
                                                                 value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </td>
                                                    <td class="action">
                                                        <a href="{{ url('admin/show-artist',$artist->id) }}">
                                                            <button type="button" class="icon-btn preview">
                                                                <i class="fal fa-eye"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/edit-artist',$artist->id) }}">
                                                            <button type="button" class="icon-btn edit">
                                                                <i class="fal fa-edit"></i>
                                                                
                                                            </button>
                                                        </a>
                                                        <a href="{{ url('admin/delete-artist',$artist->id) }}">
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