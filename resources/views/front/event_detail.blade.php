@extends('layouts.front')
@section('content')
    <section class="tfed-hero">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="tfed-back">
                        <a href="{{ route('front.event_listing') }}" class="text-btn"> <i class="fal fa-long-arrow-left"></i> Back </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="tfed-hero-caption wow fadeInUp">
                        <h1> {{ $event_detail->event_name }}</h1>
                        @if($event_detail->organizer!="")
                        <h5> {{ $event_detail->organizer }} </h5>
                        @endif
                        <p> {{ substr($event_detail->description,0,50) }}</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="hero-eventDetail-form wow fadeInUp">
                        <div class="eventDetail-hero-box">
                            <h4> Date & Time </h4>
                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ date('D, j M Y',strtotime($event_detail->event_date)) }} {{ $event_detail->event_time }}</span>
                            <h4 class="edt-label"> Ticket Price </h4>
                            <span class="ed-price">${{ number_format(Helper::getMinEventTicketPrice($event_detail->id),2,".",",") }} </span>
                            @auth('front')
                                @if($event_detail->event_date>date('Y-m-d'))
                                    <a href="{{ route('front.event_ticket_booking',$event_detail->slug) }}" class="btn btn-blue w-100"> Book Tickets </a>
                                @endif
                            @else
                            <a href="{{ route('front-login') }}" class="btn btn-blue w-100"> Book Tickets </a>
                            @endauth
                        </div>
                        <div class="bottom-shape"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="eventDetail-main-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="edm-left-box">
                        <div class="edm-des-content">
                            <div class="edm-title">
                                <h2> Description </h2>
                            </div>
                            <div class="content">
                                <p>{{ $event_detail->description }}</p>
                            </div>
                        </div>
                        @if(!$event_detail->getEventArtists->isEmpty())
                        <div class="edm-artist-content">
                            <div class="edm-title">
                                <h2> Artist Performing </h2>
                            </div>
                            <div class="edm-artist-list">
                                @foreach($event_detail->getEventArtists as $event_artist)
                                    <div class="edm-artist-item">
                                        <div class="edm-artist-img">
                                            <img src="{{ asset('/public/uploads/'.$event_artist->artist_image) }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="edm-artist-right">
                                            <h6>
                                              @php
                                                   $string =$event_artist->artist_name;
                                                   if (strlen($string) > 10) {
                                                    $stringCut = substr($string, 0, 10);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                    }
                                                  echo $string;                               
                                             @endphp
                                            </h6>
                                            <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ $event_artist->getGenreDetails->genre_name }} </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    @if(!$event_detail->getVenue->getVenueImages->isEmpty())
                        @php $img_cnt = 1; @endphp
                        <div class="edm-media-content">
                            <div class="edm-title">
                                <h2> Media </h2>
                            </div>

                            <div class="edm-media-block">
                                <div class="edm-media-list">
                                    @foreach($event_detail->getVenue->getVenueImages as $images)
                                    <div class="edm-media-item">
                                        <div class="edm-media-img">
                                            <img src="{{ asset('/public/uploads/'.$images->image_media) }}" class="img-fluid" alt="" />
                                        </div>
                                        <!-- <a class="play-btn" href="Javascript:void(0);">
                                            <span> <i class="fas fa-play"></i> </span>
                                        </a> -->
                                    </div>
                                        @if($img_cnt==3)
                                            @break
                                        @endif
                                        @php $img_cnt++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="edm-right-box">
                        <div class="edm-map-block">
                            <div class="edm-title">
                                <h2> Venue Map </h2>
                            </div>
                            <div class="edm-map">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD0lEWnbKTRtwlCkw9ZmkFYsZTGxkJ4juU&q={{ $event_detail->getVenue->venue_address }}" height="340" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                <h5> {{ $event_detail->getVenue->venue_name }} </h5>
                                <span> {{ $event_detail->getVenue->venue_address }} </span>
                            </div>
                        </div>

                        <div class="edm-social-block">
                            <div class="edm-title">
                                <h2> Share with Friends </h2>
                            </div>

                            <div class="edm-social-list">
                                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                <a href="https://twitter.com/" target="_blank"> <i class="fab fa-twitter"></i> </a>
                                <a href="https://www.instagram.com/" target="_blank"> <i class="fab fa-instagram"></i> </a>
                                <a href="https://linkedin.com/" target="_blank"> <i class="fab fa-linkedin-in"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if(!$other_events->isEmpty())
    <section class="youMayLike-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-4">
                        <h2> Other Events You May Like </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfel-list">
                        @foreach($other_events as $other_event)
                            <div class="tfel-item wow zoomIn">
                                <div class="tfel-img">
                                    <a href="{{ route('front.event_detail',$other_event->slug) }}"><img src="{{ asset('/public/uploads/'.$other_event->event_header_image) }}" class="img-fluid" alt="" /></a>
                                    <div class="tfel-price">
                                        <span> ${{ number_format(Helper::getMinEventTicketPrice($other_event->id),2,".",",") }} </span>
                                    </div>
                                    @auth("front")
                                        @if(Helper::IsLikedEvent($other_event->id))
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $other_event->id }}','remove');">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        @else
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $other_event->id }}','add');">
                                                <i class="fal fa-heart"></i>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <div class="tfel-content">
                                    <div class="tfel-logo">
                                        <img src="{{ asset('/public/uploads/'.$other_event->event_logo) }}" class="img-fluid" alt="" />
                                    </div>
                                    <div class="tfel-inner-content">
                                        <div class="tfelc-top">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ date('D, j M Y',strtotime($other_event->event_date)) }} {{ $other_event->event_time }}</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $other_event->getVenue->venue_name }}</span>
                                        </div>
                                        <h3> <a href="{{ route('front.event_detail',$other_event->slug) }}">
                                          @php
                                                $string =$other_event->event_name ;
                                                if (strlen($string) > 15) {
                                                    $stringCut = substr($string, 0, 15);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                         @endphp
                                        </a></h3>
                                        <a href="{{ route('front.event_detail',$other_event->slug) }}" class="btn-text blue-text"> View Details </a>
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
@endsection