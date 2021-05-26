@extends('layouts.front')
@section('content')
    <section class="myaccount-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="myaccount-hero-caption wow fadeInUp">
                        <h1> Favourite </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


@if(!empty($list_events))
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
                                        <span> ${{ number_format(Helper::getMinEventTicketPrice($event->id),2,".",",") }} </span>
                                    </div>
                                    @auth("front")
                                    @if($event->event_date>=date('Y-m-d'))
                                        @if(Helper::IsLikedEvent($event->id))
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $event->id }}','remove');">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        @else
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $event->id }}','add');">
                                                <i class="fal fa-heart"></i>
                                            </div>
                                        @endif
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
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> KidZania Dubai</span>
                                        </div>
                                        <h3> <a href="{{ route('front.event_detail',$event->slug) }}"> {{ $event->event_name }}</a></h3>
                                        <a href="{{ route('front.event_detail',$event->slug) }}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                <div class="col-12">
                    <div class="tfel-loadMore-block wow fadeInUp delay-4s">
                        {{ $list_events->withQueryString()->links() }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection