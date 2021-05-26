@extends('layouts.admin')
@section('content')
        <div class="page-title col-sm-12">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 m-0">Dashboard</h1>
                </div>
                <div class="col-md-6">
                    <!-- <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav> -->
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <h6>Total Users</h6>
                                <p class="h1 m-0">{{ Helper::get_users_count() }}</p>
                            </div>
                            <div class="box-icon cart">
                                <div id="today-revenue" style='width: 100%; height: 100px;'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <h6>Total Category</h6>
                                <p class="h1 m-0">{{ Helper::get_categories_count() }}</p>
                            </div>
                            <div class="box-icon cart">
                                <div id="product-sold" style='width: 100%; height: 100px;'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <h6>Total Venue</h6>
                                <p class="h1 m-0">{{ Helper::get_venues_count() }}</p>
                            </div>
                            <div class="box-icon cart">
                                <div id="product-sold" style='width: 100%; height: 100px;'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <h6>Total Artist</h6>
                                <p class="h1 m-0">{{ Helper::get_artists_count() }}</p>
                            </div>
                            <div class="box-icon cart">
                                <div id="product-sold" style='width: 100%; height: 100px;'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="box bg-white">
                        <div class="box-row">
                            <div class="box-content">
                                <h6>Total Event</h6>
                                <p class="h1 m-0">{{ Helper::get_events_count() }}</p>
                            </div>
                            <div class="box-icon cart">
                                <div id="product-sold" style='width: 100%; height: 100px;'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection