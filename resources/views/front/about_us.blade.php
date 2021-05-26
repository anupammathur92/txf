@extends('layouts.front')
@section('content')
<section class="tfcat-hero about-hero">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-8">
                    <div class="tfcat-hero-caption wow fadeInUp">
                        <h1> About Us </h1>
                        <p> Lorem Ipsum is simply dummy text of the printing. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@php
    echo $content_detail->content;
@endphp
    <!-- <section class="about-con-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="aboutCon-block wow fadeInUp">
                        <h2> Welcome To <span> TixFair </span> </h2>
                        <h6> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</h6>
                        <div class="ac-des">
                            <p> when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                            <p> when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release.when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ali-block">
                        <div class="ali-item">
                            <div class="ali-img wow flipInX">
                                <img src="{{ asset('public/images/front/about/event-1.jpg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="ali-img wow flipInX">
                                <img src="{{ asset('public/images/front/about/event-3.jpg') }}" class="img-fluid" alt="" />
                            </div>
                        </div>

                        <div class="ali-item">
                            <div class="ali-img wow flipInX">
                                <img src="{{ asset('public/images/front/about/event-2.jpg') }}" class="img-fluid" alt="" />
                            </div>
                            <div class="ali-img wow flipInX">
                                <img src="{{ asset('public/images/front/about/event-4.jpg') }}" class="img-fluid" alt="" />
                            </div>
                        </div>
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
    </section>  -->
@endsection