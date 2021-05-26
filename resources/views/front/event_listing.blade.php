@extends('layouts.front')

@section('content')
    <section class="tfel-hero">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-8">
                    <div class="tfel-hero-caption wow fadeInUp">
                        <h1> Events </h1>
                        <p> Book it. Love it. Festicket. </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <form class="sortBy-form text-right wow fadeInUp">
                        <div class="form-group mb-0">
                            <label> Sort by : </label>
                            <select id="sort_by_selector" name="sort_by_selector" class="form-control">
                                <option
                                @if(request()->get('sort_by') && request()->get('sort_by')=='earliest')
                                    selected
                                @endif
                                 value="earliest"> Earliest </option>
                                <option 
                                @if(request()->get('sort_by') && request()->get('sort_by')=='low_to_high')
                                    selected
                                @endif
                                value="low_to_high">Ticket Price: Low to High </option>
                                <option 
                                @if(request()->get('sort_by') && request()->get('sort_by')=='high_to_low')
                                    selected
                                @endif
                                value="high_to_low">Ticket Price: High to Low </option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@php $event_name = ""; $event_date_range = ""; @endphp
@if(request()->get('event_name'))
  @php $event_name = request()->get('event_name'); @endphp
@endif
@if(request()->get('event_date_range') && request()->get('event_date_range')!='')
  @php
    $event_date_range = request()->get('event_date_range');
  @endphp
@endif

    <section class="tf-searchEvent-filter wow fadeInUp delay-4s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfsef-block">
                        <h2> Search Events </h2>
                        <form class="tfsef-form" id="filterForm" method="GET" action="{{ route('front.event_listing') }}">
                            <input type="hidden" name="sort_by" id="sort_by" value="">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input name="event_name" type="text" class="form-control" placeholder="Search by Name" value="{{ $event_name }}" />
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control" name="category_id">
                                        <option value=""> Select Category Type </option>
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

                                <div class="form-group col-md-4">
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
                                <div class="catOpen-filter col-12">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <select class="form-control" name="artist_id">
                                                <option value=""> Select Artist </option>
                                                @if(!$list_artists->isEmpty())
                                                    @foreach($list_artists as $artist)
                                                        <option
                                                            @if(request()->get('artist_id') && $artist->id==request()->get('artist_id'))
                                                                selected
                                                            @endif
                                                        value="{{ $artist->id }}"> {{ $artist->artist_name }} </option>
                                                    @endforeach
                                                @endif                                    
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control" placeholder="Event Date Range" name="event_date_range" value="{{ $event_date_range }}" />
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <div id="slider-range"></div>
                                            <div class="slider-labels">
                                                <div class="caption">
                                                    <strong>Min:</strong> <span id="slider-range-value1"></span>
                                                </div>
                                                <div class="caption">
                                                    <strong>Max:</strong> <span id="slider-range-value2"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="price_min_value" id="slider_min_value" value="">
                                            <input type="hidden" name="price_max_value" id="slider_max_value" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button onclick="applyEventListingFilter();" type="button" class="btn btn-darkBlue btn-sm tfsef-discover-btn">  <i class="fal fa-search"></i> Discover </button>
                            <button type="button" class="btn btn-darkBlue tfsef-filter-btn">  <i class="fal fa-filter filterIcon"></i> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!$list_events->isEmpty())
    <section class="tfel-event-listing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfel-list">
                        @foreach($list_events as $event)
                            <div class="tfel-item wow zoomIn">
                                <div class="tfel-img">
                                    <a href="{{ route('front.event_detail',$event->slug) }}"><img src="{{ asset('/public/uploads/'.$event->event_header_image) }}" class="img-fluid" alt="" /></a>
                                    <div class="tfel-price">
                                        <span> ${{ number_format($event->per_ticket_price,2,".",",") }} </span>
                                    </div>
                                    @auth("front")
                                        @if(Helper::IsLikedEvent($event->id))
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $event->id }}','remove');">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        @else
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $event->id }}','add');">
                                                <i class="fal fa-heart"></i>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <div class="tfel-content">
                                    <div class="tfel-logo">
                                        <img src="{{ asset('/public/uploads/'.$event->event_logo) }}" class="img-fluid" alt="" />
                                    </div>
                                    <div class="tfel-inner-content">
                                        <div class="tfelc-top">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ date('D, j M Y',strtotime($event->event_date)) }} {{ $event->event_time }}</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $event->venue_name }}</span>
                                        </div>
                                        <h3> <a href="{{ route('front.event_detail',$event->slug) }}">
                                         @php
                                                $string =$event->event_name ;
                                                if (strlen($string) > 18) {
                                                    $stringCut = substr($string, 0, 18);
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
                <div class="col-12">
                    <div class="tfel-loadMore-block wow fadeInUp delay-4s">
                        {{ $list_events->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection