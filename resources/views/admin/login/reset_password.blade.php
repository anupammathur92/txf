@extends('layouts.admin_login')
@section('content')
    <div class="login-page">
        <div class="login-box">
            <div class="contentBox">
                <div class="logo d-flex flex-wrap w-100">
                    <img src="{{ asset('public/images/logo.png') }}" alt="logo">
                </div>
                <h1>Reset Password</h1>
                @include('flash-message')
                <form class="mt-5" method="POST" action="{{ route('admin.reset',$token) }}">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        @if($errors->has('email'))
                            <span class="error" style="color:red;font-size:15px">{{$errors->first('email')}}</span>
                         @endif
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" name="password">
                        </div>
                        @if($errors->has('password'))
                            <span class="error" style="color:red;font-size:15px">{{$errors->first('password')}}</span>
                         @endif
                    </div>
                    <div class="form-group">
                        <label>Confirm Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" name="password_confirmation">
                        </div>
                        @if($errors->has('password_confirmation'))
                            <span class="error" style="color:red;font-size:15px">{{$errors->first('password_confirmation')}}</span>
                         @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn w-100">Submit</button>
                    </div>
                    <div class="text-center">
                        <p>Back to <a href="{{ route('admin-login') }}">Login</a></p>
                    </div>
                </form>
            </div>
            <div class="imgBox d-none d-md-block">
                <img src="{{ asset('public/images/login.jpg') }}" alt="logo">
            </div>
        </div>
    </div>
@endsection