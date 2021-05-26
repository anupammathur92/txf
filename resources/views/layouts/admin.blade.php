<!doctype html>
<html>
@include('admin.header')
<body>
    <div class="navbar navbar-expand flex-column flex-md-row align-items-center navbar-custom">
    @include('admin.head')
    </div>
    @include('admin.sidebar')
    <div class="main-content">
        @include('flash-message')
        @yield('content')
        <div class="col-sm-12 copyright">
            <p>©2020 All Rights Reserved.  <a href="{{ route('front') }}">TixFair</a></p>
        </div>
    </div>
    @include('admin.footer')
</body>
</html>