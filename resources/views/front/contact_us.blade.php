@extends('layouts.front')
@section('content')
    <section class="tfcat-hero contact-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfcat-hero-caption wow fadeInUp">
                        <h1> Get in touch </h1>
                        <p> with an event expert </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="contact-blocks">
        <div class="container">
            <div class="row">
                <div class="col-md-4 block wow fadeInUp delay-2s">
                    <div class="inner-box">
                        <div class="icon"><i class="far fa-headphones-alt"></i></div>
                        <h3>Contact With Phone Number</h3>
                        <div class="content">
                            <a href="tel:+11234567890">+1 1234567890</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 block wow fadeInUp delay-5s">
                    <div class="inner-box">
                        <div class="icon"><i class="far fa-envelope"></i></div>
                        <h3>Email Address</h3>
                        <div class="content">
                            <a href="mailto:example@gmail.com">example@gmail.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 block wow fadeInUp delay-7s">
                    <div class="inner-box">
                        <div class="icon"><i class="far fa-map-marker-alt"></i></div>
                        <h3>Location</h3>
                        <div class="content">
                            <p> 319 Step Road, Langhorne Creek, South Australia 5255 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-sm-12 mx-auto">
                    <form class="form wow fadeInUpBig" method="POST" action="{{ route('front.store_contact_us') }}">
                        @csrf
                        <div class="section-title text-center">
                            <h2>Lets Talk!</h2>
                            <p>We do noramlly get back within 48hrs. Please leave a message</p>
                        </div>
                        @include('flash-message')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Full Name" value="{{ old('full_name') }}">
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label>Last Name </label>
                                <input type="text" class="form-control" placeholder="Last Name">
                            </div> -->
                            <div class="form-group col-md-6">
                                <label>Email Address </label>
                                <input type="email" name="email" class="form-control" placeholder="yourname@gmail.com" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label> Mobile Number </label>
                                <div class="phone-number position-relative">
                                    <select class="form-control country-code" name="country_code">
                                        @if(!$country_codes->isEmpty())
                                            @foreach($country_codes as $country_code)
                                                <option
                                                @if(old('country_code')=='' && $country_code->phonecode=='+61')
                                                    selected
                                                @elseif($country_code->phonecode==old('country_code'))
                                                    selected
                                                @endif
                                                value="{{ $country_code->phonecode }}">{{ $country_code->phonecode }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input class="form-control" type="number" placeholder="Mobile Number" name="mob_no" value="{{ old('mob_no') }}">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label>Subject </label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                            </div>
                            <div class="form-group col-12">
                                <label>Your Comments </label>
                                <textarea name="comments" class="form-control" rows="6" placeholder="Write message">{{ old('comments') }}</textarea>
                            </div>
                            <div class="form-submit col-12 text-center pt-4">
                                <button type="submit" class="btn btn-blue btn-md"><span class="btn-title">Submit</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection