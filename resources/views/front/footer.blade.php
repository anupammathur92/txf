    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-info footer-item">
                        <div class="footer-logo">
                            <img src="{{ asset('public/images/front/footer-logo.svg') }}" class="img-fluid" alt="" />
                        </div>
                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been. </p>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/TixFair/" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                            <a href="https://twitter.com/FairTix" target="_blank"> <i class="fab fa-twitter"></i> </a>
                            <a href="https://www.instagram.com/" target="_blank"> <i class="fab fa-instagram"></i> </a>
                            <a href="https://linkedin.com/" target="_blank"> <i class="fab fa-linkedin-in"></i> </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="footer-item footer-middle-item">
                        <div class="footer-link-title">
                            <h3> Quick Link </h3>
                        </div>
                        <div class="footer-link-list">
                            <ul>
                                <li><a href="{{ route('front') }}"> Home </a></li>
                                <li><a href="{{ route('front.event_listing') }}"> Events </a></li>
                                <li><a href="{{ route('front.artist_listing') }}"> Artists </a></li>
                                <li><a href="{{ route('front.categories') }}"> Categories </a></li>
                                <li><a href="{{ route('front.venue_listing') }}"> Venues </a></li>
                                <li><a href="{{ route('front.about_us') }}"> About </a></li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#hostAnEvent-modal"> Host an Event </a></li>
                                <li><a href="{{ route('front.contact_us') }}"> Contact Us </a></li>
                                <li><a href="{{ route('front.privacy_policy') }}"> Privacy Policy </a></li>
                                <li><a href="{{ route('front.terms_conditions') }}"> Terms and Conditions </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-item">
                        <div class="footer-link-title">
                            <h3> Subscribe to our newsletter </h3>
                        </div>
                        <div class="footer-newsletter">
                            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                            <form>
                                <div class="form-group">
                                    <input type="text" id="subscribe_email" name="subscribe_email" placeholder="Email Address" class="form-control" />
                                    <button type="button" onclick="addSubscription();" class="btn btn-blue btn-md"> Subscribe </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="copyright-text text-center">
                        <span class="d-block"> ©2020 All Rights Reserved. TixFair </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="slide_cus_modal hostAnEvent-modal-wrap" id="hostAnEvent-modal">
        <div class="slide_modal_body">
            <div class="modal_inner">
                <div class="slide_modal-close">
                    <button type="button" class="slide-close" data-dismiss="modal" aria-label="Close"> <i class="fal fa-arrow-left"></i> </button>
                </div>
                <div class="m_header">
                    <h2> Enquiry Form </h2>
                    <p> Lorem ipsum adipiscing elit. </p>
                </div>
                <div class="m_body enQuire-modal-body">
                    <form class="form" method="POST" id="enquiryForm" action="{{ route('front.store_enquiry') }}">
                        @csrf
                        <div class="row">
                            <div class="form-middle-title col-12">
                                <h4> Organizer Details </h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label> Contact Name </label>
                                <input name="contact_name" class="form-control" type="text" placeholder="Contact Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label> Organizer/Business Name </label>
                                <input name="organizer_name" class="form-control" type="text" placeholder="Organizer/Business Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label> Email Address </label>
                                <input name="email" class="form-control" type="email" placeholder="Email Address">
                            </div>
@php 
$countrys = Helper::getCountries();
@endphp
                            <div class="form-group col-md-6">
                                <label> Phone Number </label>
                                <div class="phone-number position-relative">
                                    <select class="form-control gray-placeholder country-code" name="country_code">
                                            @if(isset($countrys) && !$countrys->isEmpty())
                                                @foreach($countrys as $country_code)
                                                    <option
                                                    @if($country_code->phonecode=='+61')
                                                        selected
                                                    @endif
                                                    value="{{ $country_code->phonecode }}">{{ $country_code->phonecode }}</option>
                                                @endforeach
                                            @endif
                                    </select>
                                    <input name="mob_no" min="0" class="form-control" type="number" placeholder="Phone Number">
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label> Address </label>
                                <input name="address" class="form-control" type="text" placeholder="Address">
                            </div>

                            <div class="form-middle-title col-12">
                                <h4> Event Details </h4>
                            </div>

                            <div class="form-group col-md-6">
                                <label> Event Name </label>
                                <input name="event_name" class="form-control" type="text" placeholder="Event Name">
                            </div>

                            <div class="form-group date1 col-md-6 datePicker-from-group" id="datepicker2" data-target-input="nearest">
                                <label> Date </label>
                                <input name="event_date" type="text" class="form-control datepicker datetimepicker-input" placeholder="Date" data-target="#datepicker2" data-toggle="datetimepicker">
                            </div>

                            <div class="form-group col-md-6">
                                <label> Expected number of Guests </label>
                                <input name="tot_guests" min="1" class="form-control" type="number" placeholder="Expected number of Guests">
                            </div>

                            <div class="col-md-6 form-group">
                                <label> Additional Details </label>
                                <div class="addDetail-group">
                                    <div class="custom-radio-block">
                                        <input type="radio" class="d-none" id="free-event" name="event_payment_type" value="free" checked>
                                        <label class="custom-radio-label" for="free-event"> Free </label>
                                    </div>

                                    <div class="custom-radio-block">
                                        <input type="radio" class="d-none" id="paid-event" name="event_payment_type" value="paid">
                                        <label class="custom-radio-label" for="paid-event"> Paid </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-submit mt-3">
                                <a onclick="storeEnquiry();" class="btn btn-blue btn-md"> Submit </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="to-top-container">
        <a href="javascript:" id="return-to-top">
            <i class="fal fa-chevron-up"></i>
        </a>
    </div>
    <script type="text/javascript" src="{{ asset('public/js/front/script.js') }}"></script>
    @php $route = Route::currentRouteName(); @endphp
    @if($route=="front.event_listing")
        <script type="text/javascript" src="{{ asset('public/js/front/range-slider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/front/daterangepicker.min.js') }}"></script>
    @endif
    @if($route=="front.event_ticket_booking_cart")
        <script src="https://js.stripe.com/v3/"></script>
          <script type="text/javascript">
            // Create an instance of the Stripe object with your publishable API key
            var stripe = Stripe("{{ getenv('STRIPE_KEY') }}");
            var checkoutButton = document.getElementById("checkout-button");

            checkoutButton.addEventListener("click", function () {
                var ticket_booking_id = $("#ticket_booking_id").val();
              fetch("{{ route('front.create_checkout_session') }}", {
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              })
                .then(function (response) {
                  return response.json();
                })
                .then(function (session) {
                  return stripe.redirectToCheckout({ sessionId: session.id });
                })
                .then(function (result) {
                  // If redirectToCheckout fails due to a browser or network
                  // error, you should display the localized error message to your
                  // customer using error.message.
                  if (result.error) {
                    alert(result.error.message);
                  }
                })
                .catch(function (error) {
                  console.error("Error:", error);
                });
            });
          </script>
    @endif
<script type="text/javascript">
$(document).ready(function(){
    var sl_start = "<?php echo isset(request()->price_min_value) ? request()->price_min_value : '1' ?>";
    var sl_end = "<?php echo isset(request()->price_max_value) ? request()->price_max_value : '1000' ?>";
  $('.noUi-handle').on('click', function() {
    $(this).width(50);
  });
  var rangeSlider = document.getElementById('slider-range');
  var moneyFormat = wNumb({
    decimals: 0,
    thousand: ',',
    prefix: '$'
  });
  noUiSlider.create(rangeSlider, {
    start: [sl_start, sl_end],
    step: 1,
    range: {
      'min': [1],
      'max': [1000]
    },
    format: moneyFormat,
    connect: true
  });
  
  // Set visual min and max values and also update value hidden form inputs
  rangeSlider.noUiSlider.on('update', function(values, handle) {
    
    document.getElementById('slider-range-value1').innerHTML = values[0];
    document.getElementById('slider-range-value2').innerHTML = values[1];
    document.getElementById("slider_min_value").value = moneyFormat.from(values[0]);
    document.getElementById("slider_max_value").value = moneyFormat.from(values[1]);
  });
});

$(function() {
    $('input[name="event_date_range"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        format: 'DD-MM-YYYY',
        cancelLabel: 'Clear'
      }
    });
    $('input[name="event_date_range"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' _ ' + picker.endDate.format('DD-MM-YYYY'));
    });

    $('input[name="event_date_range"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

});
$("#show_password").on("click",function(){
    if($("input[name='password']").val()!=""){
        $("#show_password").hide();
        $("#hide_password").show();
        $("input[name='password']").attr("type","text");
    }
});
$("#hide_password").on("click",function(){
    $("#hide_password").hide();
    $("#show_password").show();
    $("input[name='password']").attr("type","password");
});
$("#register_show_password").on("click",function(){
    if($("input[name='password']").val()!=""){
        $("#register_show_password").hide();
        $("#register_hide_password").show();
        $("input[name='password']").attr("type","text");
    }
});
$("#register_hide_password").on("click",function(){
    $("#register_hide_password").hide();
    $("#register_show_password").show();
    $("input[name='password']").attr("type","password");
});
$("#register_show_confirm_password").on("click",function(){
    if($("input[name='confirm_password']").val()!=""){
        $("#register_show_confirm_password").hide();
        $("#register_hide_confirm_password").show();
        $("input[name='confirm_password']").attr("type","text");
    }
});
$("#register_hide_confirm_password").on("click",function(){
    $("#register_hide_confirm_password").hide();
    $("#register_show_confirm_password").show();
    $("input[name='confirm_password']").attr("type","password");
});
$(function(){
    var dateFormat = "DD-MM-YYYY";
    var CurrDate = "<?php echo isset($user_details->dob) ?  date('d-m-Y',strtotime($user_details->dob)) :  date('d-m-Y') ?>";
    var MinDate = "<?php echo date('d-m-Y'); ?>";
    var MaxDate =  "<?php echo date('d-m-Y'); ?>";

    dateCurr = moment(CurrDate, dateFormat);
    dateMin = moment(MinDate, dateFormat);
    dateMax = moment(MaxDate, dateFormat);

    $("#dob").datetimepicker({
        format: dateFormat,
        date: dateCurr,
        maxDate: dateMax,
    });
    $("#profile_dob").datetimepicker({
        format: dateFormat,
        date: dateCurr,
        maxDate: dateMax,
    });
    $("#datepicker2").datetimepicker({
        format: dateFormat,
        date: dateCurr,
    });
});
$("#dob").keypress(function(event) {event.preventDefault();});
$("#profile_dob").keypress(function(event) {event.preventDefault();});

$("#pay_now").on("click",function(){
    var qty = 0;
    var err = 1;
    $(".chkQty").each(function(){
        qty = $(this).val();
        if(qty>0){
            err = 0;
            return false;
        }
    });
    if(err==1){
        swal({
            title: "Invalid no. of tickets",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false
        });
        //alert('Invalid no. of tickets');
    }else{
        window.location.href= "{{ route('front.collect_payment_details') }}";
    }
});

function readMore(){
    $("#shortArtistBio").hide();
    $("#fullArtistBio").show();
}
function addSubscription(){
    var sub_email = $("#subscribe_email").val();
    if(sub_email==""){
        swal({
            title: "Please fill email",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false
        });
        //alert("Please fill email");
    }else{
    $.ajax({
        url : "{{ route('front.store_news_subscription') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{sub_email:sub_email},
        success:function(resp){
            if(resp.status_code=='success'){
                swal({
                    title: resp.message,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
                // alert(resp.message);
                // window.location.reload();
            }else{
                swal({
                 title: resp.message,
                 text: "",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
                 closeOnClickOutside: false
                });
               // alert(resp.message);
            }
        },
        error:function(err){
            alert('Something went wrong11');
        }
    });
    }
}
function increaseTickets(booking_id,max_tickets){
    max_tickets = parseInt(max_tickets);
    var qty = $("#qty_"+booking_id).val();
    qty = parseInt(qty);

    if(qty<max_tickets){
        qty = parseInt(qty) + parseInt(1);
        $("#qty_"+booking_id).val(qty);

        updateTickets(booking_id,qty);
    }
}
function decreaseTickets(booking_id,max_tickets){
    max_tickets = parseInt(max_tickets);
    var qty = $("#qty_"+booking_id).val();
    qty = parseInt(qty);

    if(qty>0){
        qty = parseInt(qty) - parseInt(1);
        $("#qty_"+booking_id).val(qty);
        updateTickets(booking_id,qty);
    }
}
function applyEventListingFilter(){
    var sort_by = $("#sort_by_selector").val();
    $("#sort_by").val(sort_by);

    $("#filterForm").submit();
}

function send_invite_email(){
    var booking_id = $("#invite_booking_id").val();
    var invite_name = $("#invite_name").val();
    var invite_email = $("#invite_email").val();
    $.ajax({
        url : "{{ route('front.send_invite_email') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{booking_id:booking_id,invite_email:invite_email,invite_name:invite_name},
        success:function(resp){
            resp = JSON.parse(resp);
            if(resp.status=='success'){
                swal({
                    title: resp.msg,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
                // alert(resp.msg);
                // window.location.reload();
            }else{
                alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong11');
        }
    });
}
function showInviteModal(booking_id){
    $("#send_invite_form")[0].reset();
    $("#invite_booking_id").val(booking_id);
}
function updateEventLikeStatus(event_id,status){
    $.ajax({
        url : "{{ route('front.update_event_like') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{event_id:event_id,status:status},
        success:function(resp){
            resp = JSON.parse(resp);
            console.log(resp.msg);
            if(resp.status=='success'){
                swal({
                    title: resp.msg,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
                //alert(resp.msg);
               // window.location.reload();
            }else{
                swal({
                    title: resp.msg,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
                //alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
}

function updateVenueLikeStatus(venue_id,status){
    $.ajax({
        url : "{{ route('front.update_venue_like') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{venue_id:venue_id,status:status},
        success:function(resp){
            resp = JSON.parse(resp);
            if(resp.status=='success'){
                alert(resp.msg);
                window.location.reload();
            }else{
                alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
}
function resetChangePasswordForm(){
    $("#changePasswordForm")[0].reset();
}
function resetEnquiryForm(){
    $("#enquiryForm")[0].reset();
}
function storeEnquiry(){
    $.ajax({
        url : "{{ route('front.store_enquiry') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:$("#enquiryForm").serialize(),
        success:function(resp){
            if(resp.status=='200'){
                swal({
                    title: resp.msg,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
                //window.location.reload();
            }else{
                swal({
                    title: resp.msg,
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                // alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
}
function updateTickets(booking_id,no_of_tickets){

    $.ajax({
        url : "{{ route('front.update_ticktet_booking') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{booking_id:booking_id,no_of_tickets:no_of_tickets},
        success:function(resp){
            resp = JSON.parse(resp);
            //console.log(resp);
            if(resp.status=='success'){
                getCartDetails();
                $("#event_tot_price_"+booking_id).html(resp.tot_ticket_amt);
            }else{
                alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
}
function getCartDetails(){
    $.ajax({
        url : "{{ route('front.get_cart_details') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(resp){
            resp = JSON.parse(resp);
            //console.log(resp);
            if(resp.status=='success'){
                $("#tot_ticket_price").html(resp.tot_amt);
            }else{
                alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
}
function changePassword(){
    var old_password = $("input[name='old_password']").val();
    var new_password = $("input[name='new_password']").val();
    var confirm_password = $("input[name='confirm_password']").val();

    $.ajax({
        url : "{{ route('front.change_password') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{old_password:old_password, new_password:new_password, confirm_password:confirm_password},
        success:function(resp){
            resp = JSON.parse(resp);
            if(resp.status=='success'){
                swal({
                    title: "Password Successfully Changed",
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
            }else{
                swal({
                    title: resp.msg,
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    closeOnClickOutside: false
                    })
                    .then((value) => {
                        swal(window.location.reload());
                    });
                //alert(resp.msg);
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
}
</script>
