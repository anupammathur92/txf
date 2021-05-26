@extends('layouts.front')
@section('content')
    <section class="auth-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 m-auto">
                    <div class="auth-content-wrap auth-register-content">
                        <div class="auth-title text-center">
                            <h2> Register to TixFair</h2>
                            <p> Let's get you all set up so you can verify your personal account <br class="d-none d-md-block" /> and begin setting up your profile. </p>
                        </div>
                        @include('flash-message')
                        <form class="auth-form auth-register-form row" method="POST" action="{{ route('front.store_user') }}">
                            @csrf
                            <div class="form-group col-md-6">
                                <label> Full Name </label>
                                <input name="full_name" type="text" placeholder="First Name" class="form-control" value="{{ old('full_name') }}" />
                                @if($errors->has('full_name'))
                                <span class="error" style="color:red;font-size:15px">{{$errors->first('full_name')}}</span>
                               @endif
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label> Last Name </label>
                                <input type="email" placeholder="Last Name" class="form-control" />
                            </div> -->
                            <div class="form-group col-md-6">
                                <label> Email Address </label>
                                <input name="email" type="email" placeholder="Email Address" class="form-control" value="{{ old('email') }}"/>
                                @if($errors->has('email'))
                                  <span class="error" style="color:red;font-size:15px">{{$errors->first('email')}}</span>
                               @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label> Mobile Number </label>
                                <div class="phone-number position-relative">
                                    <select name="country_code" class="form-control country-code">
                                        @if(!$country_codes->isEmpty())
                                            @foreach($country_codes as $country_code)
                                                <option
                                                @if(old('country_code')=='' && $country_code->phonecode=="+61")
                                                    selected
                                                @elseif($country_code->phonecode==old('country_code'))
                                                    selected
                                                @endif
                                                value="{{ $country_code->phonecode }}">{{ $country_code->phonecode }} {{$country_code->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input class="form-control" name="mob_no" min="0" minlength="4" maxlength="12" type="number" placeholder="Mobile Number" value="{{ old('mob_no') }}">
                                </div>
                                @if($errors->has('mob_no'))
                                <span class="error" style="color:red;font-size:15px">{{$errors->first('mob_no')}}</span>
                               @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label> Gender(optional*)</label>
                                <select name="gender" class="form-control">
                                    <option value=""> Select gender </option>
                                    <option {{ old('gender') == 'male' ? "selected" : "" }} value="male">Male</option>
                                    <option {{ old('gender') == 'female' ? "selected" : "" }} value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group date1 col-md-6 datePicker-from-group" id="dob" data-target-input="nearest">
                                <label> Date of Birth </label>
                                <input type="text" name="dob" class="form-control datepicker datetimepicker-input" placeholder="Date of Birth" data-target="#dob" data-toggle="datetimepicker">
                            </div>
                            @if($errors->has('dob'))
                                <span class="error" style="color:red;font-size:15px">{{$errors->first('dob')}}</span>
                               @endif

                            <div class="form-group col-md-6">
                                <label> Password </label>
                                <div class="password-group position-relative">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                    <button type="button" id="register_show_password" class="password-eye"><i class="far fa-eye"></i> </button>
                                    <button style='display:none;' type="button" id="register_hide_password" class="password-eye"><i class="far fa-eye-slash"></i></button>
                                </div>
                                @if($errors->has('password'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('password')}}</span>
                            @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label> Confirm Password </label>
                                <div class="password-group position-relative">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                                    <button type="button" id="register_show_confirm_password" class="password-eye"><i class="far fa-eye"></i></button>
                                    <button style='display:none;' type="button" id="register_hide_confirm_password" class="password-eye"><i class="far fa-eye-slash"></i></button>
                                </div>
                                @if($errors->has('confirm_password'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('confirm_password')}}</span>
                            @endif
                            </div>

                            <div class="form-group position-relative col-12">
                                <div class="form-checkbox">
                                    <div class="custom-check-block">
                                        <input type="checkbox" name="t_c" value="1" class="d-none" 
                                            @if(old('t_c')==1)
                                                checked
                                            @endif
                                            id="agreeYou">
                                        <label class="custom-check-label" for="agreeYou"> By creating an acount you agree to the <a href="{{ route('front.terms_conditions') }}" target="_blank"> Term & conditions</a> and our <a href="{{ route('front.privacy_policy') }}" target="_blank"> Privacy Policy.</a> </label>
                                    </div>
                                    @if($errors->has('t_c'))
                                      <span class="error" style="color:red;font-size:15px">{{$errors->first('t_c')}}</span>
                            @endif
                                </div>
                            </div>

                            <div class="auth-form-submit col-12">
                                <button type="submit" class="btn btn-blue w-100"> Register </button>
                            </div>

                            <!-- <div class="middleLine-sep col-12"> <span> OR Register WITH </span></div>

                            <div class="login-social col-12">
                                <button class="social-log-btn facebook" type="button" tabindex="0"><i class="fab fa-facebook"></i>Log in with Facebook</button>
                                <button class="social-log-btn twitter" type="button" tabindex="0"> <i class="fab fa-twitter"></i> Log in with Twitter</button>
                            </div> -->

                            <div class="auth-bottom-info text-center col-12">
                                <p> Already have an account? <a href="{{ route('front-login') }}"> Login </a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection