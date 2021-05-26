@extends('layouts.front')
@section('content')
    <section class="auth-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-8 m-auto">
                    <div class="auth-content-wrap auth-login-content">
                        <div class="auth-title text-center">
                            <h2> Login to TixFair</h2>
                            <p> Thank you for get back to Tixfair, let's access our the best recommendation for you.</p>
                        </div>
                        @include('flash-message')
                        <form class="auth-form auth-login-form" method="POST" action="{{ route('front.login') }}">
                            @csrf
                            <div class="form-group">
                                <label> Email Address </label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" class="form-control" />
                                @if($errors->has('email'))
                                <span class="error" style="color:red;font-size:15px">{{$errors->first('email')}}</span>
                               @endif
                            </div>
                            

                            <div class="form-group">
                                <label> Password </label>
                                <div class="password-group position-relative">
                                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Password" class="form-control">
                                    <button type="button" id="show_password" class="password-eye"><i class="far fa-eye"></i></button>
                                    <button style='display:none;' type="button" id="hide_password" class="password-eye"><i class="far fa-eye-slash"></i></button>
                                    <!-- Use this Off Eye Icon '<i class="far fa-eye-slash"></i>' -->
                                </div>
                                @if($errors->has('password'))
                                <span class="error" style="color:red;font-size:15px">{{$errors->first('password')}}</span>
                               @endif
                            </div>

                            <div class="forgot-link">
                                <div class="form-checkbox">
                                    <div class="custom-check-block">
                                        <input type="hidden" name="remember" value="0">
                                        <input type="checkbox" class="d-none" id="remember" name="remember" value="1">
                                        <label class="custom-check-label" for="remember"> Remember me </label>
                                    </div>
                                </div> 

                                <a href="{{ route('front.forgot_password') }}"> Forgot Password? </a>
                            </div>

                            <div class="auth-form-submit">
                                <button type="submit" class="btn btn-blue w-100"> Login </button>
                            </div>

                            <!-- <div class="middleLine-sep"> <span> OR LOGIN WITH </span></div>

                            <div class="login-social">
                                <button class="social-log-btn facebook" type="button" tabindex="0"><i class="fab fa-facebook"></i>Login with Facebook</button>
                                <button class="social-log-btn twitter" type="button" tabindex="0"> <i class="fab fa-twitter"></i> Login with Twitter</button>
                            </div> -->

                            <div class="auth-bottom-info text-center">
                                <p> Don't have any account? <a href="{{ route('front.create_user') }}"> Register </a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
