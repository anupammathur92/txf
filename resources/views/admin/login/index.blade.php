@extends('layouts.admin_login')
@section('content')
    <div class="login-page">
        <div class="login-box">
            <div class="contentBox">
                <div class="logo d-flex flex-wrap w-100">
                    <img src="{{ asset('public/images/logo.png') }}" alt="logo">
                </div>
                <h1>Welcome to TixFair!</h1>
                <p>Enter your email address and password to access admin panel.</p>
                @include('flash-message')
                <form class="mt-4" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-envelope"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control" autocomplete="off">
                        </div>
                          @if($errors->has('email'))
                            <span class="error" style="color:red;font-size:15px">{{$errors->first('email')}}</span>
                         @endif
                    </div>
                    <div class="form-group">
                        <label>Password <a class="float-right" href="{{ route('admin.forgot_password') }}">Forgot your password?</a></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" autocomplete="off">
                        </div>
                        @if($errors->has('password'))
                            <span class="error" style="color:red;font-size:15px">{{$errors->first('password')}}</span>
                         @endif
                    </div>
                    <!-- <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div> -->
                    <div class="form-group mb-0">
                        <button type="submit" class="btn w-100">Login</button>
                    </div>
                </form>
            </div>
            <div class="imgBox d-none d-md-block">
                <img src="{{ asset('public/images/login.jpg') }}" alt="image">
            </div>
        </div>
    </div>
@endsection