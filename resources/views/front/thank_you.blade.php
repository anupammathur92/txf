@extends('layouts.front')
@section('content')
    <section class="myaccount-hero thankYou-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="myaccount-hero-caption text-center wow fadeInUp">
                        <img src="{{ asset('public/images/front/thumb-icon.svg') }}" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="thankYou-content-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tyc-inner text-center">
                        <h1> Thank You !</h1>
                        <h5> <i class="fas fa-check-circle"></i> Your payment request has been accepted. </h5>
                        <p> Once your payment is confirmed your bookings will be available under "My Tickets" section <!-- a copy of the booking confirmation <br class="d-none d-md-block" /> will be sent to you shortly.  --></p>
                        <!-- <button class="btn btn-blue donwload-btn"> Download Ticket </button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection