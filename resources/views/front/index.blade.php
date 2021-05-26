@extends('layouts.front')
@section('content')
@include('flash-message')
    <section class="tf-home-hero">
        <div class="home-hero-slider">
            <div class="tfhh-slide">
                <div class="tfhh-slide-img">
                    <img src="" alt="" data-lazy="{{ asset('public/images/front/banner.jpg') }}" class="full-image animated" data-animation-in="zoomInImage"/>
                </div>
                <div class="hero-caption container">
                    <div class="hero-caption-inner">
                        <h1 class="animated" data-animation-in="fadeInUp" data-delay-in="0.3"> Connect through online <span> events </span> </h1>
                        <p class="animated" data-animation-in="fadeInUp"> Book it. Love it. Festicket. </p>
                    </div>
                </div>
            </div>
            <div class="tfhh-slide">
                <div class="tfhh-slide-img">
                    <img src="" alt="" data-lazy="{{ asset('public/images/front/banner.jpg') }}" class="full-image animated" data-animation-in="zoomInImage"/>
                </div>
                <div class="hero-caption container">
                    <div class="hero-caption-inner">
                        <h1 class="animated" data-animation-in="fadeInUp" data-delay-in="0.3"> Connect through online <span> events </span> </h1>
                        <p class="animated" data-animation-in="fadeInUp"> Book it. Love it. Festicket. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container hero-searchCat-container">
            <div class="hero-searchCat-form wow fadeInUp">
                <h4> Search event or category </h4>
                <form method="GET" action="{{ route('front.event_listing') }}">
                    <div class="form-group">
                        <div class="form-group date1" id="datepicker1" data-target-input="nearest">
                            <input name="event_name" type="text" placeholder="Search by Names" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id">
                            <option value=""> Select Event Type</option>
                            @if(!$list_categories->isEmpty())
                                @foreach($list_categories as $category)
                                    <option 
                                        @if(request()->get('category_id') && $category->id==request()->get('category_id'))
                                            selected
                                        @endif
                                    value="{{ $category->id }}"> {{ $category->category_name }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="venue_id">
                            <option value=""> Select Event Venue </option>
                            @if(!$list_venues->isEmpty())
                                @foreach($list_venues as $venue)
                                    <option
                                        @if(request()->get('venue_id') && $venue->id==request()->get('venue_id'))
                                            selected
                                        @endif
                                    value="{{ $venue->id }}"> {{ $venue->venue_name }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="event-submit-block">
                        <button type="submit" class="btn btn-blue btn-sm">  <i class="fal fa-search"></i> Discover </button>
                    </div>
                </form>

                <div class="bottom-shape"></div>
            </div>
        </div>
    </section>
    @if(!$featured_events->isEmpty())
    <section class="featured-event-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title flex-title wow zoomIn">
                        <h2> Featured Events </h2>
                        <a href="{{ route('front.event_listing') }}" class="btn-text blue-text"> See All </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 px-0">
                    <div class="fes-slider wow zoomIn">
                        @foreach($featured_events as $featured_event)
                        <div class="fes-item">
                            <div class="fes-inner-block">
                                <div class="fes-img">
                                    <a href="{{ route('front.event_detail',$featured_event->slug) }}"><img src="{{ asset('/public/uploads/'.$featured_event->event_header_image) }}" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="fes-content">
                                    <div class="fes-content-head">
                                        <div class="fes-event-logo">
                                            <img src="{{ asset('/public/uploads/'.$featured_event->event_logo) }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="fes-head-right">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ date('D, j M Y',strtotime($featured_event->event_date)) }} {{ $featured_event->event_time }}</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt=""> {{ $featured_event->getVenue->venue_name }} </span>
                                        </div>
                                    </div>
                                    <div class="fes-content-body">
                                        <h3><a href="{{ route('front.event_detail',$featured_event->slug) }}"> 
                                          @php
                                                $string =$featured_event->event_name ;
                                                if (strlen($string) > 15) {
                                                    $stringCut = substr($string, 0, 15);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                         @endphp
                                        </a></h3>
                                        <p> {{ $featured_event->description }} </p>
                                    </div>
                                    <div class="fes-content-footer">
                                        <a href="{{ route('front.event_detail',$featured_event->slug) }}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(!$list_categories->isEmpty())
    <section class="tfh-categories-section wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2> Categories</h2>
                    </div>
                </div>

                <div class="col-12">
                    <div class="tfh-category-slider">
                        @foreach($list_categories as $list_category)
                            <a href="{{ url('front/event-listing?category_id'.'='.$list_category->id) }}" class="tfh-cat-item">
                                <div class="tfhc-icon">
                                    <img src="{{ asset('/public/uploads/'.$list_category->category_image) }}" class="img-fluid" alt="" />
                                </div>
                                <div class="tfhc-title">
                                    <h3> {{ $list_category->category_name }} </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!$upcoming_events->isEmpty())
    <section class="tfh-upcomingEvent-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center wow fadeInUp">
                        <h2> Upcoming Events </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfh-ue-slider upcoming-event-slider wow zoomIn">
                        @foreach($upcoming_events as $event)
                            <div class="ue-item">
                                <div class="ue-img">
                                    <img src="{{ asset('/public/uploads/'.$event->event_header_image) }}" class="img-fluid" alt=""/>
                                </div>
                                <div class="ue-content">
                                    <div class="ue-logo">
                                        <img src="{{ asset('/public/uploads/'.$event->event_logo) }}" class="img-fluid" alt=""/>
                                    </div>
                                    <div class="ue-inner-content">
                                        <div class="uec-top">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ date('D, j M Y',strtotime($event->event_date)) }} {{ $event->event_time }}</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $event->getVenue->venue_name }}</span>
                                        </div>
                                        <h3> <a href="{{ route('front.event_detail',$event->slug) }}"> 
                                         @php
                                                $string =$event->event_name ;
                                                if (strlen($string) > 15) {
                                                    $stringCut = substr($string, 0, 15);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                             @endphp
                                        </a></h3>
                                        <a href="{{ route('front.event_detail',$event->slug) }}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(!$top_venus->isEmpty())
    <section class="tfh-upcomingEvent-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center wow fadeInUp">
                        <h2> Top Venues  </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfh-ue-slider upcoming-event-slider wow zoomIn">
                        @foreach($top_venus as $data)
                        
                            <div class="ue-item">
                                <div class="ue-img">
                                    <img src="{{ asset('/public/uploads/'.$data->getVenue->venue_header_image) }}" class="img-fluid" alt=""/>
                                </div>
                                <div class="ue-content">
                                    <div class="ue-logo">
                                        <img src="{{ asset('/public/uploads/'.$data->getVenue->venue_logo) }}" class="img-fluid" alt=""/>
                                    </div>
                                    <div class="ue-inner-content">
                                        <h3> <a href="{{route('front.venue_listing')}}"> 
                                         @php
                                                $string =$data->getVenue->venue_name ;
                                                if (strlen($string) > 15) {
                                                    $stringCut = substr($string, 0, 15);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                             @endphp
                                        </a></h3>
                                        <a href="{{route('front.venue_listing')}}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    {{--<section class="top-artists-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2> Top Artists </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="artists-list">
                        @foreach($artists as $artist)
                            <div class="artist-item wow fadeInUp delay-2s">
                                <div class="artist-left">
                                    <div class="artist-img">
                                        <img src="{{ asset('/public/uploads/'.$artist->artist_image) }}" class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="artist-right">
                                    <h4> 
                                    @php
                                                $string =$artist->artist_name ;
                                                if (strlen($string) > 8) {
                                                    $stringCut = substr($string, 0, 8);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                    @endphp
                                     </h4>
                                    <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ $artist->getGenreDetails->genre_name }} </span>
                                    <a href="{{ route('front.artist_detail',$artist->slug) }}" class="blue-text btn-text"> View Details </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="more-artists-block text-center wow fadeInUp delay-6s">
                        <a href="{{ route('front.artist_listing') }}" class="btn btn-blue btn-md"> View All Artists </a>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
   {{-- <section class="work-withus-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-5">
                    <div class="wwu-img wow slideInLeft">
                        <img src="{{ asset('public/images/front/work-with-us.jpg') }}" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <div class="wwu-right-box wow slideInRight">
                        <div class="section-title">
                            <h2> How To Work With Us </h2>
                        </div>
                        <div class="wwu-block">
                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 01 </span> How to Register?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>

                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 02 </span> How to check for an artist details?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>

                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 03 </span> How to book tickets for an event?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>

                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 04 </span> How to host an event?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    @endsection