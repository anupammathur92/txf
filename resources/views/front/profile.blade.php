@extends('layouts.front')
@section('content')
    <section class="myaccount-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="myaccount-hero-caption wow fadeInUp">
                        <h1> My Account </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="myAccount-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-md-12 m-auto">
                    <div class="myAccount-inner-block">
                        <div class="myAcccount-head text-center">
                            <div class="ma-icon">
                                <img src="{{ asset('public/images/front/user-icon.svg') }}" class="img-fluid" alt="">
                            </div>
                            <h2> {{ $user_details->full_name }} </h2>
                        </div>
                        @include('flash-message')
                        <div class="mai-block">
                            <form class="row" method="POST" action="{{ route('front.update_profile') }}">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label> Full Name </label>
                                    <input name="full_name" type="text" placeholder="Full Name" class="form-control" value="{{ $user_details->full_name }}"/>
                                </div>

                                <div class="form-group col-md-6">
                                    <label> Email Address </label>
                                    <input name="email" type="email" placeholder="Email Address" class="form-control" value="{{ $user_details->email }}"/>
                                </div>

                                <div class="form-group col-md-6">
                                    <label> Mobile Number </label>
                                    <div class="phone-number position-relative">
                                        <select name="country_code" class="form-control country-code">
                                            @if(!$country_codes->isEmpty())
                                                @foreach($country_codes as $country_code)
                                                    <option
                                                    @if($country_code->phonecode==$user_details->country_code)
                                                        selected
                                                    @endif
                                                    value="{{ $country_code->phonecode }}">{{ $country_code->phonecode }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input class="form-control" min="0" minlength="4" maxlength="12" name="mob_no" value="{{ $user_details->mob_no }}" type="number" placeholder="Mobile Number">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label> Gender </label>
                                    <select name="gender" class="form-control">
                                        <option> Select gender </option>
                                        <option
                                        @if($user_details->gender=="male")
                                            selected
                                        @endif
                                        value="male"> Male </option>
                                        <option
                                        @if($user_details->gender=="female")
                                            selected
                                        @endif
                                        value="female"> Female </option>
                                    </select>
                                </div>

                                <div class="form-group date1 col-md-6 datePicker-from-group" id="profile_dob" data-target-input="nearest">
                                    <label> Date of Birth </label>
                                    <input type="text" name="dob" class="form-control datepicker datetimepicker-input" placeholder="Date of Birth" data-target="#profile_dob" data-toggle="datetimepicker">
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="chnagePas-label">
                                        <label> Password </label>
                                    </div>
                                    <a href="javascript:void(0)" onclick="resetChangePasswordForm();" data-toggle="modal" data-target="#chagnePassword-modal"> Change Password </a>
                                    <!-- <input type="passowrd" placeholder="Password" class="form-control" value="" /> -->
                                </div>

                                <div class="auth-form-submit col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-blue"> Update My Account </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade cpm-wrapper" id="chagnePassword-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Change Password </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fal fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="cp-form" id="changePasswordForm">
                        <div class="form-group">
                            <label> Old Password  </label>
                            <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                        </div>

                        <div class="form-group">
                            <label>New Password </label>
                            <input type="password" name="new_password" class="form-control" placeholder="New Password">
                        </div>

                        <div class="form-group">
                            <label>Confirm New Password </label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                        </div>

                        <div class="cpm-modal-footer form-group">
                            <button type="button" class="btn btn-gray" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-blue" onclick="changePassword();"> Update Password </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection