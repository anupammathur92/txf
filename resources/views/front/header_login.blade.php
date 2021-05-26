<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

@php $route = Route::currentRouteName(); @endphp

@php $title= "TixFair Home"; @endphp

@if($route=='front')
    @php $title= "TixFair Home"; @endphp
@elseif($route=='front.event_listing')
    @php $title= "TixFair Events"; @endphp
@elseif($route=='front.artist_listing')
    @php $title= "TixFair Artist Listing"; @endphp
@elseif($route=='front.categories')
    @php $title= "TixFair Categories"; @endphp
@elseif($route=='front.venue_listing')
    @php $title= "TixFair Venue Listing"; @endphp
@elseif($route=='front.about_us')
    @php $title= "TixFair About Us"; @endphp
@elseif($route=='front.contact_us')
    @php $title= "TixFair Contact Us"; @endphp
@elseif($route=='front.privacy_policy')
    @php $title= "Privacy and Cookie policy"; @endphp
@elseif($route=='front.terms_conditions')
    @php $title= "Terms Of Website Use"; @endphp
@elseif($route=='front.event_ticket_booking_cart')
    @php $title= "Event Ticket Booking"; @endphp
@elseif($route=='front.venue_detail')
    @php $title= "Venue Detail"; @endphp
@elseif($route=='front.event_detail')
    @php $title= "Event Detail"; @endphp
@elseif($route=='front-login')
    @php $title= "Login"; @endphp
@elseif($route=='front.create_user')
    @php $title= "Register"; @endphp
@elseif($route=='front.forgot_password')
    @php $title= "Forgot Password"; @endphp
@elseif($route=='front.profile')
    @php $title= "My Account"; @endphp
@elseif($route=='front.my_tickets')
    @php $title= "My Tickets"; @endphp
@elseif($route=='front.favourite_events')
    @php $title= "Favoutite"; @endphp
@elseif($route=='front.artist_detail')
    @php $title= "Artist Details"; @endphp
@elseif($route=='front.collect_payment_details')
    @php $title= "Payment"; @endphp
@elseif($route=='front.thank_you')
    @php $title= "Thank You"; @endphp
@endif
    <title> {{ $title }} </title>
    <link rel="shortcut icon" href="{{ asset('public/images/front/favicon.png') }}" type="image/png">
    <link href="{{ asset('public/css/front/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/front/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/front/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/front/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/front/tempusdominus-bootstrap-4.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/front/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/front/responsive.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/front/lobibox-font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/front/lobibox.min.css')}}">
    <script type="text/javascript" src="{{ asset('public/js/front/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/bootstrap.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/tempusdominus-bootstrap-4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/slick-animation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/front/script.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{asset('public/js/front/lobibox.js')}}"></script>
    
    
    @if($route=="front.event_listing")
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/front/daterangepicker.css') }}">
    @endif
</head>
<body>
    <header class="site-header">
      <nav class="navbar tixfair-default-navbar container-fluid">
        <div class="tixfair-navLogo-side">
          <a class="navbar-brand" href="{{ route('front') }}">
            <img src="{{ asset('public/images/front/logo.svg') }}" class="img-fluid" alt="" />
          </a>
        </div>
        <div class="navbar-collapse tixfair-rightNav-side" id="navbarNav">
          <div class="menuOverlay menuClose"></div>
          <button class="navbar-toggler closeBtn menuClose" type="button"> <span class="navbar-toggler-icon"></span> </button>
          <ul class="navbar-nav">
            <li class="nav-item"><a 
                @if($route=='front')
                    class="active"
                @endif
                href="{{ route('front') }}"> Home </a></li>
            <li class="nav-item"><a 
                @if($route=='front.event_listing')
                    class="active"
                @endif
                href="{{ route('front.event_listing') }}"> Events </a></li>
            <li class="nav-item"><a 
                @if($route=='front.artist_listing')
                    class="active"
                @endif
                href="{{ route('front.artist_listing') }}"> Artists</a></li>
            <li class="nav-item"><a 
                @if($route=='front.categories')
                    class="active"
                @endif
                href="{{ route('front.categories') }}"> Categories </a></li>
            <li class="nav-item"><a 
                @if($route=='front.venue_listing')
                    class="active"
                @endif
                href="{{ route('front.venue_listing') }}"> Venues </a></li>
            <li class="nav-item"><a 
                @if($route=='front.about_us')
                    class="active"
                @endif
                href="{{ route('front.about_us') }}"> About </a></li>
            <li class="nav-item"><a href="javascript:void(0);" onclick="resetEnquiryForm();" data-toggle="modal" data-target="#hostAnEvent-modal"> Host an Event </a></li>
            <li class="nav-item"><a 
                @if($route=='contact_us')
                    class="active"
                @endif
                href="{{ route('front.contact_us') }}">  Contact Us </a></li>
            <li class="nav-item btn-item">
            @auth('front')
                <li class="nav-item user-btn-item d-none d-xl-block">
                <div class="user-menu dropdown d-none d-xl-block">
                    <button class="dropdown-toggle btn user-btn" type="button" id="userMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span class="user-name"> {{ auth('front')->user()->full_name }} <i class="fal fa-chevron-down"></i> </span>  <div class="userBtn-icon"> <img src="{{ asset('public/images/front/user-icon.svg') }}" class="img-fluid" alt="" /> </div></button>
                    <div class="dropdown-menu" aria-labelledby="userMenuButton">
                        <a class="dropdown-item" href="{{ route('front.profile') }}"> <i class="far fa-user"></i> My Account </a>
                        <a class="dropdown-item" href="{{ route('front.my_tickets') }}"> <i class="far fa-ticket-alt"></i> My Tickets </a>
                        <a class="dropdown-item" href="{{ route('front.favourite_events') }}"> <i class="far fa-heart"></i> Favourite </a>
                        <a class="dropdown-item" href="{{ route('front.logout') }}"> <i class="far fa-sign-out"></i> Logout</a>
                    </div>
                </div>
                </li>
              @endauth

              @guest('front')
                <a href="{{ route('front-login') }}" class="btn btn-blue"> <img src="{{ asset('public/images/front/user-icon.svg') }}" class="img-fluid" alt="" /> Log in / Sign up </a>
              @endguest
              </li>
          </ul>
        </div>
        <div class="mobileRight-menu-block d-xl-none">
          <button class="navbar-toggler menuOpen" type="button"> <span class="navbar-toggler-icon"></span> </button>
        </div>
      </nav>
    </header>