@extends('layouts.front')
@section('content')
    <section class="auth-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-8 m-auto">
                    <div class="auth-content-wrap">
                        <div class="auth-title text-center">
                            <h2> Verify Email </h2>
                            <!-- <p> Enter the email address associated with your account and we will send an email with instructions to reset your password. </p> -->
                        </div>
                        @include('flash-message')
                        <form class="auth-form auth-login-form" method="POST" action="{{ route('front.verify_email',$token) }}">
                            @csrf
                            <div class="form-group">
                                <label> Email Address </label>
                                <input name="email" type="email" placeholder="Email Address" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label> OTP </label>
                                <input name="otp" type="text" placeholder="OTP" class="form-control"/>
                            </div>
                            <div class="auth-form-submit">
                                <button type="submit" class="btn btn-blue w-100"> Verify </button>
                            </div>
                            <div class="auth-back-page text-center">
                                <a href="{{ route('front-login') }}"> <i class="fal fa-long-arrow-left"></i> Login </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection