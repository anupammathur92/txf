<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\User;
use App\TicketBookingCart;
use App\TicketBooking;
use App\EventTicketDetail;
use App\Payment;
use App\Event;
use Stripe;
use Auth;
use Helper;
Use PDF;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware('auth');
    }
    public function create_checkout_session(Request $request){

        $booking_details = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with('getEventTicketDetails')->pluck("id")->toArray();
        $book_id = "";
        if(!empty($booking_details)){
            $book_id = implode(",",$booking_details);
        }
        $tot_amt = 0.00;
        $tot_amt = Helper::get_total_cart_value_in_value();
        /*if(!empty($booking_details)){
            $tot_amt = $booking_details->no_of_tickets*$booking_details->getEventTicketDetails->per_ticket_price;
        }*/

        \Stripe\Stripe::setApiKey(getenv("STRIPE_SECRET"));

        //header('Content-Type: application/json');

        $YOUR_DOMAIN = route('front.success_payment');

        $checkout_session = \Stripe\Checkout\Session::create([
          'payment_method_types' => ['card'],
          'line_items' => [[
            'price_data' => [
              'currency' => 'usd',
              'unit_amount' => $tot_amt*100,
              'product_data' => [
                'name' => 'TASK A',
              ],
            ],
            'quantity' => 1,
          ]],
          'mode' => 'payment',
          "payment_intent_data" => ["description" => $book_id],
          'success_url' => route('front.thank_you'),
          'cancel_url' => route('front.cancel_payment'),
        ]);

        $payment = new Payment();
        $payment->user_id = auth()->user()->id;
        $payment->amount = $tot_amt;
        $payment->transaction_id = $checkout_session->payment_intent;
        $payment->status = '0'; // pending
        $payment->save();

        echo json_encode(['id' => $checkout_session->id]);
    }
    public function capture_webhook(){
        $content = file_get_contents("php://input");

        $content = json_decode($content,TRUE);
        //echo "<pre>"; print_r($content); echo "</pre>"; die;
        if(isset($content["data"]["object"]["id"]) && $content["data"]["object"]["status"]){
            $payment_intent_id = $content["data"]["object"]["id"];
            if($content["data"]["object"]["status"]=="succeeded"){
                $stripe = new \Stripe\StripeClient(getenv('STRIPE_SECRET'));

                $payment_intent_resp = $stripe->paymentIntents->retrieve(
                  $payment_intent_id,
                  []
                );

                if(isset($payment_intent_resp["description"]) && $payment_intent_resp["description"]!=""){
                    $booking_cart_id = explode(",",$payment_intent_resp["description"]);
                    if(!empty($booking_cart_id)){
                        $payment = Payment::where(["transaction_id"=>$payment_intent_id])->first();

                        $ticket_booking_details = TicketBookingCart::whereIn("id",$booking_cart_id)->where("no_of_tickets",">","0")->with('getEventTicketDetails')->get();
                        foreach($ticket_booking_details as $ticket_booking_detail){
                            $ticket_booking = new TicketBooking();
                            $ticket_booking->user_id = $ticket_booking_detail->user_id;
                            $ticket_booking->event_id = $ticket_booking_detail->event_id;
                            $ticket_booking->event_ticket_id = $ticket_booking_detail->event_ticket_id;
                            $ticket_booking->payment_id = $payment->id;
                            $ticket_booking->no_of_tickets = $ticket_booking_detail->no_of_tickets;
                            $ticket_booking->per_ticket_price = $ticket_booking_detail->getEventTicketDetails->per_ticket_price;
                            $ticket_booking->tot_amount = ($ticket_booking_detail->no_of_tickets*$ticket_booking_detail->getEventTicketDetails->per_ticket_price);
                            $ticket_booking->admin_comm = $ticket_booking_detail->getEventTicketDetails->admin_comm;
                            $ticket_booking->admin_comm_val = (($ticket_booking_detail->getEventTicketDetails->admin_comm*$ticket_booking->tot_amount)/100);

                            $ticket_booking->save();
                            
                            $link_name = 'qrcode_'.$ticket_booking->id.'.svg';
                            QrCode::generate($ticket_booking->id,public_path().'/uploads/qrcode/'.$link_name);
                            $ticket_booking->qrcode_link = $link_name;
                            $ticket_booking->save();

                            $available_tickets = $ticket_booking_detail->getEventTicketDetails->total_tickets - $ticket_booking_detail->no_of_tickets;

                            EventTicketDetail::where(["id"=>$ticket_booking_detail->event_ticket_id])->update(["available_tickets"=>$available_tickets]);

                            TicketBookingCart::where(["id"=>$ticket_booking_detail->id])->delete();
                        }
                    }
                    Payment::where(["transaction_id"=>$payment_intent_id])->update(["status"=>"1"]);
                }
            }elseif($content["data"]["object"]["status"]=="failed"){
                Payment::where(["transaction_id"=>$payment_intent_id])->update(["status"=>"2"]);
            }
        }
        return 1;
        echo "process done<br>"; die;
    }
    public function cancel_payment(){
        try{
            return view('front.cancel_payment');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function check_ticket_availability(Request $request){
        $is_ticket_available = Helper::check_ticket_availability();
        $respArr = ["is_ticket_available"=>$is_ticket_available];
        echo json_encode($respArr);
    }
    public function remove_ticket_from_cart(Request $request){
        TicketBookingCart::where(["user_id"=>auth()->user()->id])->delete();
    }
    public function collect_payment_details(){
        try{
            TicketBookingCart::where(["user_id"=>auth()->user()->id,"no_of_tickets"=>0])->delete();
            $is_ticket_available = Helper::check_ticket_availability();
            if($is_ticket_available==0){
                return redirect()->route('front.event_ticket_booking_cart')->with('error','Tickets are unavailable');
            }
            $data["amt"] = Helper::get_total_cart_value_in_value();
            if($data["amt"]<=0){
                return redirect()->route('front.event_ticket_booking_cart')->with('error','Invalid Amount');
            }
            \Stripe\Stripe::setApiKey(getenv("STRIPE_SECRET"));
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $data["amt"]*100,
                'currency' => 'usd',
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);
            $data['clientSecret'] = $paymentIntent->client_secret;

            return view('front.collect_payment_details',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function process_payment(Request $request){
        try{
            $payment = new Payment();
            $payment->user_id = auth()->user()->id;
            $payment->amount = $request->amount;
            $payment->transaction_id = $request->transaction_id;
            $payment->transaction_date = $request->transaction_date;
            $payment->save();

            $ticket_booking_details = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with('getEventTicketDetails')->get();
            if(!empty($ticket_booking_details)){
                foreach($ticket_booking_details as $ticket_booking_detail){
                    $ticket_booking = new TicketBooking();
                    $ticket_booking->user_id = $ticket_booking_detail->user_id;
                    $ticket_booking->event_id = $ticket_booking_detail->event_id;
                    $ticket_booking->event_ticket_id = $ticket_booking_detail->event_ticket_id;
                    $ticket_booking->payment_id = $payment->id;
                    $ticket_booking->no_of_tickets = $ticket_booking_detail->no_of_tickets;
                    $ticket_booking->per_ticket_price = $ticket_booking_detail->getEventTicketDetails->per_ticket_price;
                    $ticket_booking->tot_amount = ($ticket_booking_detail->no_of_tickets*$ticket_booking_detail->getEventTicketDetails->per_ticket_price);
                    $ticket_booking->admin_comm = $ticket_booking_detail->getEventTicketDetails->admin_comm;
                    $ticket_booking->admin_comm_val = (($ticket_booking_detail->getEventTicketDetails->admin_comm*$ticket_booking->tot_amount)/100);

                    $ticket_booking->save();
                    
                    $link_name = 'qrcode_'.$ticket_booking->id.'.svg';
                    $encryption_data = json_encode(["booking_id"=>base64_encode($ticket_booking->id)]);
                    QrCode::generate($encryption_data,public_path().'/uploads/qrcode/'.$link_name);
                    $ticket_booking->qrcode_link = $link_name;
                    $ticket_booking->save();

                    $available_tickets = $ticket_booking_detail->getEventTicketDetails->available_tickets - $ticket_booking_detail->no_of_tickets;

                    EventTicketDetail::where(["id"=>$ticket_booking_detail->event_ticket_id])->update(["available_tickets"=>$available_tickets]);

                    TicketBookingCart::where(["id"=>$ticket_booking_detail->id])->delete();
                }
            }

            return redirect()->route('front.thank_you')->with('success','Payment Done');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function thank_you(){
        try{
            return view('front.thank_you');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
}
?>