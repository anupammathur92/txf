@extends('layouts.front')
@section('content')
    <section class="ticketBooking-hero">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="tfed-back">
                        <a href="{{ url()->previous() }}" class="text-btn"> <i class="fal fa-long-arrow-left"></i> Back </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="tfed-hero-caption wow fadeInUp">
                        <h1> {{ $event_details->event_name }} </h1>
                        @if($event_details->organizer!="")
                        <h5> {{ $event_details->organizer }} </h5>
                        @endif

                        <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ date('D, j M Y',strtotime($event_details->event_date)) }} {{ $event_details->event_time }} </span>
                        <span> <img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt=""> {{ $event_details->getVenue->venue_name }}</span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="hero-eventDetail-form wow fadeInUp">
                        <div class="eventDetail-hero-box">
                            @include('flash-message')
                            <h4 class="edt-label"> Ticket Price </h4>
                            <span class="ed-price" id="tot_ticket_price"> {{ $tot_amt }} </span>
                            <!-- <a href="{{ route('front.collect_payment_details') }}" class="btn btn-blue w-100"> Pay Now </a> -->
                            <input type="hidden" id="ticket_booking_id" value="{{ $event_details->id }}">
                            <button class="btn btn-blue w-100" type="button" id="pay_now">Pay Now</button>
                            <!-- <button class="btn btn-blue w-100" type="button" id="checkout-button">Checkout</button> -->
                        </div>
                        <div class="bottom-shape"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ticketBooking-listing-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="ticketBooking-list">
                        <div class="tbl-title">
                            <h2>  Ticket Details </h2>
                        </div>
                        <div class="tbl-block">
                            @if(!empty($ticket_booking))
                                @foreach($ticket_booking as $booking)
                                    @php
                                        $max_tickets = $booking->getEventTicketDetails->max_ticket_per_user;
                                    @endphp
                                    @if($booking->getEventTicketDetails->available_tickets<$booking->getEventTicketDetails->max_ticket_per_user)
                                        @php $max_tickets = $booking->getEventTicketDetails->available_tickets; @endphp
                                    @endif
                                    <div class="tbl-item">
                                        <div class="tblImg-bg">
                                            <img src="{{ asset('public/images/front/tb-icon.png') }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="tbl-left">
                                            <div class="tbl-img">
                                                <img src="{{ asset('/public/uploads/'.$event_details->event_header_image) }}" class="img-fluid" alt="" />
                                            </div>
                                            <div class="tbl-content">
                                                <h3> {{ $booking->getEventTicketDetails->getTicketCategory->ticket_category_name }}</h3>
                                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ date('D, j M Y',strtotime($event_details->event_date)) }} {{ $event_details->event_time }} </span>
                                                <span> <img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="">{{ $event_details->getVenue->venue_name }}</span>
                                            </div>
                                        </div>
                                        <div class="tbl-right">
                                            <div class="tbl-price">
                                                <h4 id="event_tot_price_{{ $booking->id }}"> ${{ $booking->getEventTicketDetails->per_ticket_price}}</h4>
                                                <!-- <span> Incl. fees </span>
                                                <span class="tbl-info" data-toggle="tooltip" data-placement="top" title="Tooltip on top"> <i class="fas fa-info-circle"></i></span> -->
                                            </div>
                                            <div class="tblQtyAdd-box">
                                                <button type="button" class="minus" onclick="decreaseTickets('{{ $booking->id }}','{{ $max_tickets }}');" value="{{ $booking->no_of_tickets }}"> <i class="fal fa-minus"></i> </button>
                                                <input type="number"  readonly class="qtyInput-control chkQty" name="quantity[]" id="qty_{{ $booking->id }}" min="0" max="{{ $max_tickets }}" onchange="updateTickets('{{ $booking->id }}',this.value);" value="{{ $booking->no_of_tickets }}" title="Qty" inputmode="numeric">
                                                <button type="button" class="plus" onclick="increaseTickets('{{ $booking->id }}','{{ $max_tickets }}');" value="{{ $booking->no_of_tickets }}"> <i class="fal fa-plus"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-4"> 
                    @if(!empty($upcoming_events))
                    <div class="tb-upcommigEvent-list">                  
                        <div class="tbl-title">
                            <h2> Upcoming Events </h2>
                        </div>
                        <div class="tbue-list">
                            @foreach($upcoming_events as $upcoming_event)
                            <div class="tbue-item">
                                <div class="tbue-img">
                                    <a href="event-detail.html"><img src="{{ asset('/public/uploads/'.$upcoming_event->event_header_image) }}" class="img-fluid" alt=""></a>
                                </div>
                                <div class="tbue-content">
                                    <h3> <a href="event-detail.html"> {{ $upcoming_event->event_name }} </a></h3>
                                    <div class="tbuec-top">
                                        <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ date('D, j M Y',strtotime($upcoming_event->event_date)) }} {{ $upcoming_event->event_time }}</span>
                                        <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt=""> {{ $upcoming_event->venue_name }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
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
    @endsection