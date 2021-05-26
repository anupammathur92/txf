@extends('layouts.front')
@section('content')
    <section class="tfcat-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfcat-hero-caption wow fadeInUp">
                        <h1> Categories </h1>
                        <p> Book it. Love it. Festicket. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-categories-section wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2> Popular Categories </h2>
                        <p> Here are some quick popular Categories to help you quickly find what you’re looking for. </p>
                    </div>
                </div>
                @if(!empty($categories))
                <div class="col-12">
                    <div class="popular-cat-list">
                        @foreach($categories as $category)
                            <div class="popular-cat-item">
                                <a href="{{ url('front/event-listing?category_id'.'='.$category->category_id) }}">
                                    <div class="popular-cat-content">
                                        <img src="{{ asset('/public/uploads/'.$category->getCategory->category_image) }}" class="img-fluid" alt="" />
                                        <h3> {{ $category->getCategory->category_name }} </h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endsection