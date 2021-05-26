/**** Header Js ***/
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
       $(".site-header").addClass("sticky-1");
    } else {
       $(".site-header").removeClass("sticky-1");
    }
    if (scroll >= 300) {
       $(".site-header").addClass("sticky");
    } else {
       $(".site-header").removeClass("sticky");
    }
});

$(document).ready(function(){
    $('.menuOpen').on('click', function () {
        $("#navbarNav").addClass('nav-translate');
        $("#mainBody").addClass('overflow-hidden');
    });

    $('.menuClose').on('click', function () {
        $("#navbarNav").removeClass('nav-translate');
        $("#mainBody").removeClass('overflow-hidden');
    });
});



/**** Return To Top Js ***/
$(window).scroll(function() {
    $(this).scrollTop() >= 50 ? $("#return-to-top").fadeIn(200) : $("#return-to-top").fadeOut(200)
}), $("#return-to-top").click(function() {
        $("body,html").animate({
        scrollTop: 0
    }, 500)
});

$(function () {

	new WOW().init();

	$(document).ready(function($) {
	      $('.tfh-category-slider').slick({
	        dots: false,
	        infinite: true,
	        speed: 800,
	        slidesToShow: 6,
	        slidesToScroll: 1,
	        autoplay: true,
	        autoplaySpeed: 2000,
	        arrows: true,
	        //variableWidth: true,
	        prevArrow:"<button type='button' class='prev-control slick-arrow-control'><i class='fal fa-chevron-left'></i></button>",
			nextArrow:"<button type='button' class='next-control slick-arrow-control'><i class='fal fa-chevron-right'></i></button>",
			responsive: [
				{
			      breakpoint: 1200,
			      settings: {
			        slidesToShow: 4,
			      }
			    },
			    {
			      breakpoint: 991,
			      settings: {
			        slidesToShow: 3,
			      }
			    },
			    {
			      breakpoint: 768,
			      settings: {
			        slidesToShow: 2,
			        arrows: false,
			      }
			    },
		    ]
	    });
	});

	$(document).ready(function($) {
	      $('.upcoming-event-slider').slick({
	        dots: false,
	        infinite: true,
	        speed: 900,
	        slidesToShow: 3,
	        slidesToScroll: 1,
	        autoplay: true,
	        autoplaySpeed: 2000,
	        arrows: true,
	        //variableWidth: true,
	        prevArrow:"<button type='button' class='prev-control slick-arrow-control'><i class='fal fa-chevron-left'></i></button>",
			nextArrow:"<button type='button' class='next-control slick-arrow-control'><i class='fal fa-chevron-right'></i></button>",
			responsive: [
				{
			      breakpoint: 1200,
			      settings: {
			        slidesToShow: 2,
			      }
			    },
			    {
			      breakpoint: 768,
			      settings: {
			        slidesToShow: 1,
			        arrows: false,
			      }
			    },
		    ]
	    });
	});

	$(document).ready(function($) {
	      $('.fes-slider').slick({
	        dots: false,
	        infinite: true,
	        //speed: 1000,
	        slidesToShow: 1,
	        slidesToScroll: 1,
	        //autoplay: true,
	        //autoplaySpeed: 2000,
	        arrows: true,
	        variableWidth: true,
	        centerMode: true,
	        prevArrow:"<button type='button' class='prev-control slick-arrow-control'><i class='fal fa-chevron-left'></i></button>",
			nextArrow:"<button type='button' class='next-control slick-arrow-control'><i class='fal fa-chevron-right'></i></button>",
			responsive: [
				{
			      breakpoint: 1200,
			      settings: {
			        arrows: false,
			      }
			    },
			    {
			      breakpoint: 991,
			      settings: {
			        variableWidth: false,
			        centerMode: false,
			        arrows: false,
			      }
			    },
			    {
			      breakpoint: 768,
			      settings: {
			      	variableWidth: false,
			        centerMode: false,
			        slidesToShow: 1,
			        arrows: false,
			      }
			    },
		    ]
	    });
	});
});



// Init slick slider + animation
$('.home-hero-slider').slick({
  autoplay: true,
  speed: 800,
  lazyLoad: 'progressive',
  arrows: true,
  dots: false,
	prevArrow: '<div class="slick-nav hh-slick-control prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
	nextArrow: '<div class="slick-nav hh-slick-control next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
	responsive: [
		{
	      breakpoint: 991,
	      settings: {
	        arrows: false,
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: false,
	      }
	    },
    ]
}).slickAnimation();

$('.hh-slick-control').on('click touch', function(e){
    e.preventDefault();
    var arrow = $(this);
    if(!arrow.hasClass('animate')) {
        arrow.addClass('animate');
        setTimeout(() => {
            arrow.removeClass('animate');
        }, 1600);
    }
});



$(function () {
    /*$('.datePicker-from-group').datetimepicker({
        format: 'L',
    });*/
});


/**** Filter Js *******/
$(".tfsef-filter-btn").click(function(){
    $(".catOpen-filter").toggle();
    $(this).find(".filterIcon").toggleClass("fa-filter fa-times");
});