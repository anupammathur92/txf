@extends('layouts.front')
@section('content')
    <section class="tf-home-hero">
        <div class="home-hero-slider">
            <div class="tfhh-slide">
                <div class="tfhh-slide-img">
                    <img src="" alt="" data-lazy="{{ asset('public/images/front/banner.jpg') }}" class="full-image animated" data-animation-in="zoomInImage"/>
                </div>
                <div class="hero-caption container">
                    <div class="hero-caption-inner">
                        <h1 class="animated" data-animation-in="fadeInUp" data-delay-in="0.3"> Connect through online <span> events </span> </h1>
                        <p class="animated" data-animation-in="fadeInUp"> Book it. Love it. Festicket. </p>
                    </div>
                </div>
            </div>
            <div class="tfhh-slide">
                <div class="tfhh-slide-img">
                    <img src="" alt="" data-lazy="{{ asset('public/images/front/banner.jpg') }}" class="full-image animated" data-animation-in="zoomInImage"/>
                </div>
                <div class="hero-caption container">
                    <div class="hero-caption-inner">
                        <h1 class="animated" data-animation-in="fadeInUp" data-delay-in="0.3"> Connect through online <span> events </span> </h1>
                        <p class="animated" data-animation-in="fadeInUp"> Book it. Love it. Festicket. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container hero-searchCat-container">
            <div class="hero-searchCat-form wow fadeInUp">
                <h4> Search event or category </h4>
                <form>
                    <div class="form-group">
                        <div class="form-group date1" id="datepicker1" data-target-input="nearest">
                            <input type="text" placeholder="Search by keyword" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option> Select Event Category </option>
                            <option> Food & Drink </option>
                            <option> Music </option>
                            <option> Sports & Fitness </option>
                            <option> Home & Lifestyle </option>
                            <option> Fashion & Beauty </option>
                            <option> Travel & Outdoor </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="position-relative">
                             <input type="text" class="form-control" placeholder="Search by Venue" />
                            <button type="button" class="gps-btn"> <i class="fal fa-location"></i> </button>
                        </div>
                    </div>

                    <div class="event-submit-block">
                        <button type="button" class="btn btn-blue btn-sm">  <i class="fal fa-search"></i> Discover </button>
                    </div>
                </form>

                <div class="bottom-shape"></div>
            </div>
        </div>
    </section>

    <section class="tfh-categories-section wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2> Categories </h2>
                    </div>
                </div>

                <div class="col-12">
                    <div class="tfh-category-slider">
                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/food-drink-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Food & Drink </h3>
                            </div>
                        </a>

                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/music-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Music </h3>
                            </div>
                        </a>

                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/sports-fitness-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Sports & Fitness </h3>
                            </div>
                        </a>

                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/home-lifestyle-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Home & Lifestyle </h3>
                            </div>
                        </a>

                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/fashion-beauty-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Fashion & Beauty </h3>
                            </div>
                        </a>

                        <a href=""  class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/travel-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Travel & Outdoor </h3>
                            </div>
                        </a>


                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/travel-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Travel & Outdoor </h3>
                            </div>
                        </a>

                        <a href="" class="tfh-cat-item">
                            <div class="tfhc-icon">
                                <img src="{{ asset('public/images/front/category/travel-icon.svg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="tfhc-title">
                                <h3> Travel & Outdoor </h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-event-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title flex-title wow zoomIn">
                        <h2> Featured Events </h2>
                        <a href="event-listing.html" class="btn-text blue-text"> See All </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 px-0">
                    <div class="fes-slider wow zoomIn">
                        <div class="fes-item">
                            <div class="fes-inner-block">
                                <div class="fes-img">
                                    <a href="event-detail.html"><img src="{{ asset('public/images/front/featured-event-1.jpg') }}" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="fes-content">
                                    <div class="fes-content-head">
                                        <div class="fes-event-logo">
                                            <img src="{{ asset('public/images/front/event-logo-4.png') }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="fes-head-right">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> Tue, 5 Jan 2021 11:00 AM IST</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt=""> KidZania Dubai </span>
                                        </div>
                                    </div>

                                    <div class="fes-content-body">
                                        <h3><a href="event-detail.html"> ToDA - From Monet to Kandinsky. Revolutionary Art </a></h3>
                                        <p> ToDA is the very first & unique DIGITAL ART SPACE in the UAE which offers visitors to experience art differently from a traditional gallery visit. </p>
                                    </div>

                                    <div class="fes-content-footer">
                                        <a href="event-detail.html" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fes-item">
                            <div class="fes-inner-block">
                                <div class="fes-img">
                                    <a href="event-detail.html"><img src="{{ asset('public/images/front/featured-event-2.jpg') }}" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="fes-content">
                                    <div class="fes-content-head">
                                        <div class="fes-event-logo">
                                            <img src="{{ asset('public/images/front/event-logo-4.png') }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="fes-head-right">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> Tue, 5 Jan 2021 11:00 AM IST</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt=""> KidZania Dubai </span>
                                        </div>
                                    </div>

                                    <div class="fes-content-body">
                                        <h3> <a href="event-detail.html">ToDA - From Monet to Kandinsky. Revolutionary Art</a> </h3>
                                        <p> ToDA is the very first & unique DIGITAL ART SPACE in the UAE which offers visitors to experience art differently from a traditional gallery visit. </p>
                                    </div>

                                    <div class="fes-content-footer">
                                        <a href="event-detail.html" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fes-item">
                            <div class="fes-inner-block">
                                <div class="fes-img">
                                    <a href="event-detail.html"><img src="{{ asset('public/images/front/featured-event-3.jpg') }}" class="img-fluid" alt="" /></a>
                                </div>
                                <div class="fes-content">
                                    <div class="fes-content-head">
                                        <div class="fes-event-logo">
                                            <img src="{{ asset('public/images/front/event-logo-4.png') }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="fes-head-right">
                                            <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> Tue, 5 Jan 2021 11:00 AM IST</span>
                                            <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt=""> KidZania Dubai </span>
                                        </div>
                                    </div>

                                    <div class="fes-content-body">
                                        <h3> <a href="event-detail.html">ToDA - From Monet to Kandinsky. Revolutionary Art</a> </h3>
                                        <p> ToDA is the very first & unique DIGITAL ART SPACE in the UAE which offers visitors to experience art differently from a traditional gallery visit. </p>
                                    </div>

                                    <div class="fes-content-footer">
                                        <a href="event-detail.html" class="btn-text blue-text"> View Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tfh-upcomingEvent-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center wow fadeInUp">
                        <h2> Upcoming Events </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfh-ue-slider upcoming-event-slider wow zoomIn">
                        <div class="ue-item">
                            <div class="ue-img">
                                <img src="{{ asset('public/images/front/event-1.jpg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="ue-content">
                                <div class="ue-logo">
                                    <img src="{{ asset('public/images/front/event-logo-1.jpg') }}" class="img-fluid" alt="" />
                                </div>
                                <div class="ue-inner-content">
                                    <div class="uec-top">
                                        <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Tue, 5 Jan 2021 11:00 AM IST</span>
                                        <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> KidZania Dubai</span>
                                    </div>
                                    <h3> <a href=""> ToDA - From Monet to Kandinsky... </a></h3>
                                    <a href="" class="btn-text blue-text"> View Details </a>
                                </div>
                            </div>
                        </div>

                        <div class="ue-item">
                            <div class="ue-img">
                                <img src="{{ 'public/images/front/event-2.jpg' }}" class="img-fluid" alt="" />
                            </div>
                            <div class="ue-content">
                                <div class="ue-logo">
                                    <img src="{{ 'public/images/front/event-logo-2.jpg' }}" class="img-fluid" alt="" />
                                </div>
                                <div class="ue-inner-content">
                                    <div class="uec-top">
                                        <span><img src="{{ 'public/images/front/calendar-icon.svg' }}" class="img-fluid" alt="" /> Tue, 5 Jan 2021 11:00 AM IST</span>
                                        <span><img src="{{ 'public/images/front/location-icon.svg' }}" class="img-fluid" alt="" /> KidZania Dubai</span>
                                    </div>
                                    <h3> <a href=""> ToDA - From Monet to Kandinsky... </a></h3>
                                    <a href="" class="btn-text blue-text"> View Details </a>
                                </div>
                            </div>
                        </div>

                        <div class="ue-item">
                            <div class="ue-img">
                                <img src="{{ asset('public/images/front/event-3.jpg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="ue-content">
                                <div class="ue-logo">
                                    <img src="{{ asset('public/images/front/event-logo-3.jpg') }}" class="img-fluid" alt="" />
                                </div>
                                <div class="ue-inner-content">
                                    <div class="uec-top">
                                        <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Tue, 5 Jan 2021 11:00 AM IST</span>
                                        <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> KidZania Dubai</span>
                                    </div>
                                    <h3> <a href=""> ToDA - From Monet to Kandinsky... </a></h3>
                                    <a href="" class="btn-text blue-text"> View Details </a>
                                </div>
                            </div>
                        </div>

                        <div class="ue-item">
                            <div class="ue-img">
                                <img src="{{ asset('public/images/front/event-1.jpg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="ue-content">
                                <div class="ue-logo">
                                    <img src="{{ asset('public/images/front/event-logo-1.jpg') }}" class="img-fluid" alt="" />
                                </div>
                                <div class="ue-inner-content">
                                    <div class="uec-top">
                                        <span><img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Tue, 5 Jan 2021 11:00 AM IST</span>
                                        <span><img src="{{ asset('public/images/front/location-icon.svg') }}" class="img-fluid" alt="" /> KidZania Dubai</span>
                                    </div>
                                    <h3> <a href=""> ToDA - From Monet to Kandinsky... </a></h3>
                                    <a href="" class="btn-text blue-text"> View Details </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="top-artists-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2> Top Artists </h2>
                    </div>
                </div>

                <div class="col-12">
                    <div class="artists-list">
                        <div class="artist-item wow fadeInUp delay-2s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-1.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Areena Doe </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-4s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-2.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Cameron </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-6s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-3.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Mike Hoover </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-8s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-4.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Dora Hines </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-2s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-5.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Alina Hoover </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-4s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-6.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Chuba Doe </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-6s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-7.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Olivia Doe </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>

                        <div class="artist-item wow fadeInUp delay-8s">
                            <div class="artist-left">
                                <div class="artist-img">
                                    <img src="{{ asset('public/images/front/user/user-8.jpg') }}" class="img-fluid" alt="" />
                                </div>
                            </div>
                            <div class="artist-right">
                                <h4> Robert Doe </h4>
                                <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt="" /> Genre </span>
                                <a href="" class="blue-text btn-text"> View Details </a>
                            </div>
                        </div>
                    </div>

                    <div class="more-artists-block text-center wow fadeInUp delay-6s">
                        <a href="artist-listing.html" class="btn btn-blue btn-md"> View All Artists </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="work-withus-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-5">
                    <div class="wwu-img wow slideInLeft">
                        <img src="{{ asset('public/images/front/work-with-us.jpg') }}" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <div class="wwu-right-box wow slideInRight">
                        <div class="section-title">
                            <h2> How To Work With Us </h2>
                        </div>
                        <div class="wwu-block">
                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 01 </span> How to Register?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>

                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 02 </span> How to check for an artist details?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>

                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 03 </span> How to book tickets for an event?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>

                            <div class="wwu-item">
                                <h3 class="title">
                                    <span> 04 </span> How to host an event?
                                </h3>
                                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection