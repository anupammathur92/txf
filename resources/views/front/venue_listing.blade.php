@extends('layouts.front')
@section('content')
    <section class="tfcat-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfcat-hero-caption wow fadeInUp">
                        <h1> Venue </h1>
                        <p> Book it. Love it. Festicket. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!$venues->isEmpty())
    <section class="tfel-event-listing tfVenue-listing-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfel-list">
                        @foreach($venues as $venue)
                            <div class="tfel-item wow zoomIn">
                                <div class="tfel-img">
                                    <a href="{{ route('front.venue_detail',$venue->slug) }}"><img src="{{ asset('/public/uploads/'.$venue->venue_header_image) }}" class="img-fluid" alt=""/></a>
                                </div>
                                <div class="tfel-content">
                                    <div class="tfel-logo">
                                        <img src="{{ asset('/public/uploads/'.$venue->venue_logo) }}" class="img-fluid" alt="" />
                                    </div>
                                    <div class="tfel-inner-content">
                                        <div class="tfelc-top">
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" />{{ $venue->venue_name }}</span>
                                        </div>
                                        <h3> <a href="{{ route('front.venue_detail',$venue->slug) }}">{{ implode(' ', array_slice(explode(' ', $venue->venue_name), 0, 50))}} </a></h3>
                                        <a href="{{ route('front.venue_detail',$venue->slug) }}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfel-loadMore-block wow fadeInUp delay-4s">
                        {{ $venues->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endsection