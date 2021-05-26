@extends('layouts.front')
@section('content')
    <section class="myaccount-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="myaccount-hero-caption wow fadeInUp">
                        <h1> My Tickets </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


@if(!empty($bookings))
    <section class="myTicket-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="myTicket-list">
                        @foreach($bookings as $booking)
                            <div class="myTicket-item wow zoomIn">
                                <div class="myTicket-img">
                                    <img src="{{ asset('/public/uploads/'.$booking->getEventDetails->event_header_image) }}" class="img-fluid" alt="" />
                                    <div class="myTicket-price">
                                        <span>${{ number_format($booking->per_ticket_price,2,".",",") }} </span>
                                    </div>

                                    <a href="{{ route('front.download_ticket',$booking->id) }}" class="cle-btn"> <i class="fal fa-arrow-to-bottom"></i> </a>
                                    <!-- <div class="multi-user connectUser-list">
                                        <span class="connectUser-item" title=""><img src="{{ asset('public/images/front/user/user-1.jpg') }}" class="img-fluid" alt=""></span>

                                        <span class="connectUser-item" title=""><img src="{{ asset('public/images/front/user/user-2.jpg') }}" class="img-fluid" alt=""></span>

                                        <span class="connectUser-item" title=""><img src="{{ asset('public/images/front/user/user-3.jpg') }}" class="img-fluid" alt="" ></span>

                                        <span class="connectUser-item" title=""><img src="{{ asset('public/images/front/user/user-4.jpg') }}" class="img-fluid" alt="" ></span>

                                        <span class="connectUser-item" title=""><img src="{{ asset('public/images/front/user/user-5.jpg') }}" class="img-fluid" alt="" ></span>
                                    </div> -->
                                </div>
                                <div class="myTicket-content">
                                    <div class="myTicket-inner-content">
                                        <div class="myTicket-head justifyMT-head">
                                            <h3> {{ substr($booking->getEventDetails->event_name,0,10) }}... </h3>
                                            <a onclick="showInviteModal('{{ $booking->id }}');" data-toggle="modal" data-target="#invite-modal" class="btn btn-blue"> Invite </a>
                                        </div>
                                        <div class="myTicketc-top">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> {{ date('D, j M Y',strtotime($booking->getEventDetails->event_date)) }} {{ $booking->getEventDetails->event_time }} </span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $booking->getEventDetails->getVenue->venue_name }} </span>
                                            <span><img src="{{ asset('public/images/front/category-icon.svg') }}" class="img-fluid" alt="" />{{ $booking->getEventTicketDetails->getTicketCategory->ticket_category_name }}</span>
                                            <span><img src="{{ asset('public/images/front/user-blue-icon.svg') }}" class="img-fluid" alt="" /> {{ $booking->no_of_tickets }} Ticket(s) </span>
                                        </div>
                                    </div>
                                    <div class="myTicket-amount">
                                        <span> Total Price ${{number_format($booking->no_of_tickets*$booking->per_ticket_price,2,".",",") }} </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfel-loadMore-block wow fadeInUp delay-4s">
                        {{ $bookings->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
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
                                        <span> ${{ number_format($other_event->per_ticket_price,2,".",",") }} </span>
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
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> {{ $other_event->venue_name }}</span>
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
    <div class="modal fade cpm-wrapper" id="invite-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Invite </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fal fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="cp-form" id="send_invite_form">
                        <input type="hidden" id="invite_booking_id">
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" id="invite_name" name="invite_name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" id="invite_email" name="invite_email" class="form-control" placeholder="Email">
                        </div>

                        <div class="cpm-modal-footer form-group">
                            <button type="button" class="btn btn-gray" data-dismiss="modal"> Cancel </button>
                            <button type="button" class="btn btn-blue" onclick="send_invite_email();"> Send Invite </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection