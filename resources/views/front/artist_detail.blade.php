@extends('layouts.front')
@section('content')
    <section class="tfad-hero-section">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="tfed-back">
                        <a href="{{ route('front.artist_listing') }}" class="text-btn"> <i class="fal fa-long-arrow-left"></i> Back </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfad-hero-caption wow fadeInUp">
                        <div class="tfad-caption-head">
                            <div class="tfadc-left">
                                <img src="{{ asset('/public/uploads/'.$artist_detail->artist_image) }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfadc-right">
                                <h1> {{ $artist_detail->artist_name }}</h1>
                                <h5> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ $artist_detail->getGenreDetails->genre_name }} </h5>
                            </div>
                        </div>

                        <div class="tfad-des" id="shortArtistBio">
                            <p> {{ substr($artist_detail->artist_bio,0,10) }}...<a href="javascript:void(0);" onclick="readMore();" class="text-blue"> Read More </a> </p>
                        </div>
                        <div class="tfad-des" id="fullArtistBio" style='display:none;'>
                            <p> {{ $artist_detail->artist_bio }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!$upcoming_events->isEmpty())
        <section class="upcomingEvent-deail-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2> Upcoming Events </h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="upcomingEvent-accordion-wrap">
                            <div class="upcomingEvent-accordion-item">
                                <div class="upad-title">
                                    <!-- <h3> March 2021 </h3> -->
                                </div>
                                <div class="tfel-list">
                                @foreach($upcoming_events as $event)
                                    <div class="tfel-item wow zoomIn">
                                        <div class="tfel-img">
                                            <a href="{{ route('front.event_detail',$event->slug) }}"><img src="{{ asset('/public/uploads/'.$event->event_header_image) }}" class="img-fluid" alt="" /></a>
                                            <div class="tfel-price">
                                                <span> ${{ number_format($event->per_ticket_price,2,".",",") }}</span>
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
                                                    <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" />{{ date('D, j M Y',strtotime($event->event_date)) }} {{ $event->event_time }}</span>
                                                    <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" />{{ $event->venue_name }}</span>
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
                </div>
            </div>
        </section>
    @endif
    <div class="tfArtist-fanlike-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2> Fans Also Like </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfal-list">
                    
                    @if(!$artists->isEmpty())
                        @foreach($artists as $artist)
                        <a href="{{ route('front.artist_detail',$artist->slug) }}" class="tfal-item">
                            <div class="tfArtist-content">
                                <div class="artist-img-block">
                                    <img src="{{ asset('/public/uploads/'.$artist->artist_image) }}" class="img-fluid" alt="" />
                                    <div class="tfArt-arrow"> <i class="fal fa-long-arrow-right"></i> </div>
                                </div>
                                <div class="tfa-inner">
                                    <h5> 
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
                                   </h5>
                                    <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ $artist->getGenreDetails->genre_name }} </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection