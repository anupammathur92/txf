@extends('layouts.front')
@section('content')
<style type="text/css">
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
</style>
  <script src="https://js.stripe.com/v3/"></script>
    <section class="myaccount-hero">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="myaccount-hero-caption wow fadeInUp">
                        <h1> Payment </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="myAccount-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-md-12 m-auto">
                    <div class="myAccount-inner-block">
                        <div class="myAcccount-head text-center">
                            <div class="ma-icon">
                                <img src="{{ asset('public/images/front/user-icon.svg') }}" class="img-fluid" alt="">
                            </div>
                            <h2> Payment </h2>
                        </div>

                        <div class="mai-block">
                            <form id="paymentForm" action="{{ route('front.process_payment') }}" method="post">
                                @csrf
                                <input name="transaction_id" type="hidden" id="transaction_id">
                                <input name="amount" type="hidden" value="{{ $amt }}">
                                <input name="transaction_date" id="transaction_date" type="hidden">
                                <div class="form-group col-md-6">
                                    <label> Name on card </label>
                                    <input id="card-name" type="text" class="form-control mb-2" placeholder="Enter card name">
                                </div>
                                <div class="form-group col-md-6">
                                    <div id="card-element" class="processPayment-card">
                                    <!-- Elements will create input elements here -->
                                    </div>
                                </div>
                                <div id="card-errors" role="alert"></div>
                                <div class="auth-form-submit col-12 mt-4 text-center">
                                    <button id="card-button" type="submit" class="btn btn-blue"> Pay {{ Helper::get_total_cart_value() }} </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
var stripe = Stripe("{{ getenv('STRIPE_KEY') }}");

var elements = stripe.elements();
var style = {
  base: {
    color: "#32325d",
    height: "50px",
    border: "1px solid #e4e4e4"
  }
};

var card = elements.create("card", { style: style, hidePostalCode: true });
card.mount("#card-element");

card.on('change', ({error}) => {
  let displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('paymentForm');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();
    $.ajax({
        url : "{{ route('front.check_ticket_availability') }}",
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{},
        success:function(resp){
            resp = JSON.parse(resp);
            //console.log(resp.is_ticket_available);
            if(resp.is_ticket_available=='1'){
                  stripe.confirmCardPayment("{{ $clientSecret }}", {
                    payment_method: {
                      card: card,
                      billing_details: {
                        name: $("#card-name").val()
                      }
                    }
                  }).then(function(result) {
                    if (result.error) {
                      // Show error to your customer (e.g., insufficient funds)
                      console.log(result.error.message);
                      var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                    } else {
                      // The payment has been processed!
                      if (result.paymentIntent.status === 'succeeded') {
                        //console.log(result.paymentIntent);
                        $("#transaction_id").val(result.paymentIntent.id);
                        $("#transaction_date").val(result.paymentIntent.created);
                        document.getElementById("paymentForm").submit()
                      }
                    }
                  });
            }else{
                $.ajax({
                    url : "{{ route('front.remove_ticket_from_cart') }}",
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{},
                    success:function(resp){
                        alert("No ticket available");
                        window.location.href = "{{ route('front.event_listing') }}";
                    },
                    error:function(err){
                        alert('Something went wrong');
                    }
                });
            }
        },
        error:function(err){
            alert('Something went wrong');
        }
    });
 

});
</script>
@endsection