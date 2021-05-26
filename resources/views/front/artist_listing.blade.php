@extends('layouts.front')
@section('content')
    <section class="tfArtist-list-hero">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-7">
                    <div class="tfArtist-list-hero-caption wow fadeInUp">
                        <h1> Discover Artists on <span> TixFair </span></h1>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@if(!$artists->isEmpty())
    <div class="tfArtist-list-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tfal-list">
                        @foreach($artists as $artist)
                            <a href="{{ route('front.artist_detail',$artist->slug) }}" class="tfal-item">
                                <div class="tfArtist-content">
                                    <div class="artist-img-block">
                                        <img src="{{ asset('/public/uploads/'.$artist->artist_image) }}" class="img-fluid" alt=""/>
                                        <div class="tfArt-arrow"> <i class="fal fa-long-arrow-right"></i> </div>
                                    </div>
                                    <div class="tfa-inner">
                                        <h5>
                                           @php
                                                $string =$artist->artist_name ;
                                                if (strlen($string) > 8) {
                                                    $stringCut = substr($string, 0, 8);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $string.='...';
                                                    
                                                }
                                              echo $string;                               
                                            @endphp
                                       </h5>
                                        <span> <img src="{{ asset('public/images/front/calendar-icon.svg') }}" class="img-fluid" alt=""> {{ $artist->getGenreDetails->genre_name }} </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <div class="tfel-loadMore-block wow fadeInUp delay-4s">
                        {{ $artists->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
    @endsection