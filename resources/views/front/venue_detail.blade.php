@extends('layouts.front')
@section('content')
    <section class="tfad-hero-section venue-hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfad-hero-caption wow fadeInUp">
                        <div class="tfad-caption-head mt-0">
                            <div class="tfadc-left">
                                <img src="{{ asset('/public/uploads/'.$venue_detail->venue_logo) }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfadc-right">
                                <h1> {{ $venue_detail->venue_name }} </h1>
                                <h5> <i class="far fa-map-marker-alt"></i> {{ $venue_detail->venue_address }} </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!$venue_detail->getVenueImages->isEmpty())
    <section class="venue-media-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2> Media Gallery </h2>
                    </div>
                </div>

                <div class="col-12">
                    <div class="vm-media-list" id="gallery" data-toggle="modal" data-target="#lightBox-modal-wrap">
                        @php $imgCounter = 0; @endphp
                        @foreach($venue_detail->getVenueImages as $venue_image)
                            <div class="vm-media-item">
                                <div class="vm-media-img">
                                    <img src="{{ asset('/public/uploads/'.$venue_image->image_media) }}" data-target="#lightBox-modal-slider" data-slide-to="{{ $imgCounter }}" class="img-fluid" alt="">
                                </div>
                                <div class="expend-icon">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </div>
                            </div>
                            @php $imgCounter++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!$venue_previous_events->isEmpty())
    <section class="upcomingEvent-deail-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2> Previous Events at Venue </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="upcomingEvent-accordion-wrap">
                        <div class="tfel-list">
                            @foreach($venue_previous_events as $previous_event)
                            <div class="tfel-item wow zoomIn">
                                <div class="tfel-img">
                                    <a href="{{ route('front.event_detail',$previous_event->slug) }}"><img src="{{ asset('/public/uploads/'.$previous_event->event_header_image) }}" class="img-fluid" alt="" /></a>
                                    <div class="tfel-price">
                                        <span> ${{ number_format($previous_event->per_ticket_price,2,".",",") }} </span>
                                    </div>
                                    @auth("front")
                                        @if(Helper::IsLikedEvent($previous_event->id))
                                            <!-- <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $previous_event->id }}','remove');">
                                                <i class="fas fa-heart"></i>
                                            </div> -->
                                        @else
                                            <!-- <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $previous_event->id }}','add');">
                                                <i class="fal fa-heart"></i>
                                            </div> -->
                                        @endif
                                    @endauth
                                </div>
                                <div class="tfel-content">
                                    <div class="tfel-logo">
                                        <img src="{{ asset('/public/uploads/'.$previous_event->event_logo) }}" class="img-fluid" alt=""/>
                                    </div>
                                    <div class="tfel-inner-content">
                                        <div class="tfelc-top">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ date('D, j M Y',strtotime($previous_event->event_date)) }} {{ $previous_event->event_time }}</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $venue_detail->venue_name }}</span>
                                        </div>
                                        <h3> <a href="{{ route('front.event_detail',$previous_event->slug) }}"> {{ $previous_event->event_name }} </a></h3>
                                        <a href="{{ route('front.event_detail',$previous_event->slug) }}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!$upcoming_events->isEmpty())
    <section class="upcomingEvent-deail-section venue-upcoming-detail">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2> Upcoming Events at Venue </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="upcomingEvent-accordion-wrap">
                        <div class="tfel-list">
                            @foreach($upcoming_events as $upcoming_event)
                            <div class="tfel-item wow zoomIn">
                                <div class="tfel-img">
                                    <a href="{{ route('front.event_detail',$upcoming_event->slug) }}"><img src="{{ asset('/public/uploads/'.$upcoming_event->event_header_image) }}" class="img-fluid" alt="" /></a>
                                    <div class="tfel-price">
                                        <span> ${{ number_format($upcoming_event->per_ticket_price,2,".",",") }}</span>
                                    </div>
                                    @auth("front")
                                        @if(Helper::IsLikedEvent($upcoming_event->id))
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $upcoming_event->id }}','remove');">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        @else
                                            <div class="tfel-favorite" onClick="updateEventLikeStatus('{{ $upcoming_event->id }}','add');">
                                                <i class="fal fa-heart"></i>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <div class="tfel-content">
                                    <div class="tfel-logo">
                                        <img src="{{ asset('/public/uploads/'.$upcoming_event->event_logo) }}" class="img-fluid" alt="" />
                                    </div>
                                    <div class="tfel-inner-content">
                                        <div class="tfelc-top">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ date('D, j M Y',strtotime($upcoming_event->event_date)) }} {{ $upcoming_event->event_time }}</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $venue_detail->venue_name }}</span>
                                        </div>
                                        <h3> <a href="{{ route('front.event_detail',$upcoming_event->slug) }}">
                                         @php
                                                $string =$upcoming_event->event_name ;
                                                if (strlen($string) > 15) {
                                                    $stringCut = substr($string, 0, 15);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                         @endphp
                                        </a></h3>
                                        <a href="{{ route('front.event_detail',$upcoming_event->slug) }}" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="venue-location-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2> Location </h2>
                    </div>
                </div>

                <div class="col-12">
                    <div class="location-iframe">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD0lEWnbKTRtwlCkw9ZmkFYsZTGxkJ4juU&q={{ $venue_detail->venue_address }}" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!$venue_detail->getVenueImages->isEmpty())
    <div class="modal fade medialight-box" id="lightBox-modal-wrap" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog medialight-dialog" role="document">
        <div class="modal-content">
          <div class="medialight-body">
            <div class="mediaLight-head">
                <div class="mediaLight-title">
                    <h3>{{ $venue_detail->venue_name }}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="mediaLight-slide-block">
                <div id="lightBox-modal-slider" class="lightBox-carousel carousel" data-ride="carousel">
                  <div class="carousel-inner">
                    @php $modalImgCounter = 0; @endphp
                        @foreach($venue_detail->getVenueImages as $venue_image)
                        <div class="carousel-item @if($modalImgCounter==0) {{ 'active' }} @endif">
                          <img class="d-block img-fluid" src="{{ asset('/public/uploads/'.$venue_image->image_media) }}" alt="">
                        </div>
                        @php $modalImgCounter++; @endphp
                    @endforeach
                  </div>
                  <div class="carousel-arrow-block">
                      <a class="control-prev" href="#lightBox-modal-slider" role="button" data-slide="prev">
                        <i class="fal fa-chevron-left"></i>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="control-next" href="#lightBox-modal-slider" role="button" data-slide="next">
                        <i class="fal fa-chevron-right"></i>
                        <span class="sr-only">Next</span>
                      </a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
@endsection