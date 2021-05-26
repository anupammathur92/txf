<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Artist;
use App\Country;
use App\ContactUs;
use App\Enquiry;
use App\Category;
use App\Venue;
use App\Event;
use App\EventArtist;
use App\TicketBookingCart;
use App\EventTicketDetail;
use App\TicketBooking;
use App\InvitationLog;
use App\EventLike;
use App\Content;
use App\Subscription;
use Helper;
use DB;
use PDF;

class FrontController extends Controller
{
    public function __construct(){
    }

    public function index(){
        try{
            $limit = 8;
            $data["country_codes"] = Country::get();
            // $data["artists"] = Artist::whereHas('getArtistEvents', function (Builder $query){
            //                         $query->where('event_date', '>',date("Y-m-d"));
            //                     })->with('getGenreDetails')->where(["status"=>"1"])->orderBy("popularity_sequence","ASC")->take($limit)->get();
            $data["top_venus"]=Event::groupBy('venue_id')->select('venue_id', DB::raw('count(*) as total'))->orderBy("total","DESC")->get();

            // $data["top_venus"]=DB::table('events')
            // ->join('venues', 'events.venue_id', '=', 'venues.id')
            // ->select('events.*','venues.venue_name')
            // ->select('venue_id', DB::raw('count(*) as total'))->groupBy('venue_id')->orderBy("total","desc")
            // ->get();

            $data["upcoming_events"] = Event::whereHas('getEventTickets',function($q){
                $q->where('available_tickets','>','0');
            })->where([["event_date",">",date("Y-m-d")],'status'=>"1"])->with('getVenue')->orderBy("event_date","ASC")->take("4")->get();
            $data["featured_events"] = Event::whereHas("getEventTickets",function($q){
                $q->where("available_tickets",">","0");
            })->where(["status"=>"1","is_featured"=>1,["event_date",">",date("Y-m-d")]])->with('getVenue')->orderBy("event_date","ASC")->take("3")->get();
            $data["list_categories"] = Category::where(["status"=>"1"])->orderBy("id","DESC")->get();
            $data["list_venues"] = Venue::where(["status"=>"1"])->orderBy("id","DESC")->get();

            return view('front.index',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function event_listing(Request $request){

        try{
            $limit = 6;
            $filters = $request->all();
            $where[] = ["status","=","1"];
            $where[] = ["event_date",">",date("Y-m-d")];
            
$event_query_raw = DB::table('event_ticket_details')
        ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
        ->join('venues', 'events.venue_id', '=', 'venues.id')
        ->join('event_artists', 'event_artists.event_id', '=', 'events.id')
        ->select('events.*','venues.venue_name')
        ->selectRaw('MIN(event_ticket_details.per_ticket_price) as `per_ticket_price`')
        ->where("events.event_date",">",date("Y-m-d"))
        ->where("events.status","=",1)
        ->where("event_ticket_details.available_tickets",">","0");
if($request->event_name && $request->event_name!=""){
    $event_query_raw = $event_query_raw->where("events.event_name","like","%".$request->event_name."%");
}
if($request->category_id && $request->category_id!=""){
    $event_query_raw = $event_query_raw->where("events.category_id","=",$request->category_id);
}
if($request->venue_id && $request->venue_id!=""){
    $event_query_raw = $event_query_raw->where("events.venue_id","=",$request->venue_id);
}
if($request->artist_id && $request->artist_id!=""){
    $event_query_raw = $event_query_raw->where("event_artists.artist_id","=",$request->artist_id);
}
if($request->event_date_range && $request->event_date_range!=""){
    $date_range = explode(" _ ",$request->event_date_range);
    $event_query_raw = $event_query_raw->where("events.event_date",">=",date('Y-m-d',strtotime($date_range[0])));
    $event_query_raw = $event_query_raw->where("events.event_date","<=",date('Y-m-d',strtotime($date_range[1])));
}
$event_query_raw = $event_query_raw->orderBy("events.event_date","ASC")
                        ->groupBy('event_ticket_details.event_id');
if($request->price_min_value && $request->price_min_value!=""){
    $event_query_raw = $event_query_raw->havingRaw('MIN(event_ticket_details.per_ticket_price) >= ?', [$request->price_min_value]);
}
if($request->price_max_value && $request->price_max_value!=""){
    $event_query_raw = $event_query_raw->havingRaw('MIN(event_ticket_details.per_ticket_price) <= ?', [$request->price_max_value]);
}
$event_query_raw = $event_query_raw->paginate($limit);

            $data["list_events"] = $event_query_raw;
            $data["list_categories"] = Category::where(["status"=>"1"])->orderBy("id","DESC")->get();
            $data["list_venues"] = Venue::where(["status"=>"1"])->orderBy("id","DESC")->get();
            $data["list_artists"] = Artist::where(["status"=>"1"])->orderBy("id","DESC")->get();
            
            return view('front.event_listing',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function artist_listing(){
        try{
            $limit = 15;

            $data["artists"] = Artist::where(["status"=>"1"])->with('getGenreDetails')->paginate($limit);
            return view('front.artist_listing',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function categories(){
        try{
            $data["categories"] = Event::where([['status','=','1'],['event_date','>=',date('Y-m-d')],['event_date','<=',date('Y-m-d',strtotime("+1 month"))]])->groupBy('category_id')->with('getCategory')->take('5')->get();
            return view('front.categories',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function venue_listing(){
        try{
            $limit = 6;

            $data["venues"] = Venue::whereHas('getVenueEvents.getEventTickets', function($q){
                $q->where('event_date', '>', date('Y-m-d'))->where('available_tickets','>','0')->where('status','=','1');
            })->where(["status"=>"1"])->orderBy("id","DESC")->paginate($limit);

            return view('front.venue_listing',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function about_us(){
        try{
            $data["content_detail"] = Content::where(["id"=>"1"])->first();
            return view('front.about_us',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function contact_us(){
        try{
            $data["country_codes"] = Country::get();
            return view('front.contact_us',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function event_detail($slug){
        try{
            $data["event_detail"] = Event::where(["slug"=>$slug])->with("getEventArtists","getVenue")->first();
            $data["other_events"] = Event::whereHas("getEventTickets",function($q){
                $q->where('available_tickets','>','0');
            })->where([["slug","<>",$slug],['status','=','1'],['event_date','>',date('Y-m-d')]])->orderBy("event_date","ASC")->with('getVenue')->get();
            return view('front.event_detail',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function venue_detail($slug){
        try{
            $limit = 3;

            $data["venue_detail"] = Venue::whereHas("getVenueEvents",function($q){
                            $q->where("event_date",">",date("Y-m-d"))->where('status','=','1');
                        })
                        ->with(['getVenueEvents'=> function($q){
                            $q->where("event_date",">=",date("Y-m-d"));
                            }])
                        ->where(["slug"=>$slug])
                        ->take($limit)
                        ->first();

            $data["upcoming_events"] = DB::table('event_ticket_details')
                    ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
                    ->join('venues', 'events.venue_id', '=', 'venues.id')
                    ->select('events.*','venues.venue_name')
                    ->selectRaw('MIN(event_ticket_details.per_ticket_price) as `per_ticket_price`')
                    ->where("events.event_date",">",date("Y-m-d"))
                    ->where("event_ticket_details.available_tickets",">","0")
                    ->where("venues.slug","=",$slug)
                    ->where("events.status","=",1)
                    ->orderBy('event_date','ASC')
                    ->groupBy("event_ticket_details.event_id")
                    ->limit($limit)
                    ->get();

            $data["venue_previous_events"] = DB::table('event_ticket_details')
                    ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
                    ->join('venues', 'events.venue_id', '=', 'venues.id')
                    ->select('events.*','venues.venue_name')
                    ->selectRaw('MIN(event_ticket_details.per_ticket_price) as `per_ticket_price`')
                    ->where("events.event_date","<",date("Y-m-d"))
                    //->where("event_ticket_details.available_tickets",">","0")
                    ->where("venues.slug","=",$slug)
                    ->where("events.status","=",1)
                    ->orderBy('event_date','DESC')
                    ->groupBy("event_ticket_details.event_id")
                    ->limit($limit)
                    ->get();
            /*$data["venue_previous_events"] = Venue::whereHas("getVenueEvents",function($q){
                                        $q->where("event_date","<",date("Y-m-d"))->where("status","=",1);
                                    })
                                    ->with(['getVenueEvents'=> function($q){
                                        $q->where("event_date","<",date("Y-m-d"))->where("status","=",1);
                                    }])
                                    ->where(["slug"=>$slug])
                                    ->take($limit)
                                    ->first();*/

            return view('front.venue_detail',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function artist_detail($slug){
        try{
            //DB::enableQueryLog();
            $data["artist_detail"] = Artist::where(["slug"=>$slug])->first();

            $data["upcoming_events"] = DB::table('event_ticket_details')
                    ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
                    ->join('venues', 'events.venue_id', '=', 'venues.id')
                    ->join('event_artists', 'event_artists.event_id', '=', 'events.id')
                    ->join('artists', 'artists.id', '=', 'event_artists.artist_id')
                    ->select('events.*','venues.venue_name')
                    ->selectRaw('MIN(event_ticket_details.per_ticket_price) as `per_ticket_price`')
                    ->where("events.event_date",">",date("Y-m-d"))
                    ->where("event_ticket_details.available_tickets",">","0")
                    ->where("artists.slug","=",$slug)
                    ->where("events.status","=",1)
                    ->orderBy("event_date","ASC")
                    ->groupBy("event_ticket_details.event_id")
                    ->limit("3")
                    ->get();

            $data["artists"] = Artist::whereHas('getArtistEvents', function ($q){
                                    $q->where('event_date', '>',date("Y-m-d"))->where('status', '=',1);
                                })->with('getArtistEvents','getGenreDetails')->where("slug",'<>',$slug)->get();
            //dd(DB::getQueryLog());
            //dd($data);

            return view('front.artist_detail',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function privacy_policy(){
        try{
            $data["content_detail"] = Content::where(["id"=>"2"])->first();
            return view('front.privacy_policy',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function terms_conditions(){
        try{
            $data["content_detail"] = Content::where(["id"=>"3"])->first();
            return view('front.terms_conditions',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function store_contact_us(Request $request){

        $validator = $request->validate([
            'full_name'     => 'required|string',
            'email'  => 'required|email',
            'country_code'  => 'required|string',
            'mob_no'     => 'required|numeric|digits_between:4,12',
            'subject'  => 'required|string',
            'comments'  => 'required|string',
        ]);

        try{
            $contact_us = new ContactUs();
            $contact_us->full_name = $request->full_name;
            $contact_us->email = $request->email;
            $contact_us->country_code = $request->country_code;
            $contact_us->mob_no = $request->mob_no;
            $contact_us->subject = $request->subject;
            $contact_us->comments = $request->comments;

            $contact_us_details = $contact_us->save();

            return redirect()->route('front.contact_us')->with('success','Contact Us Added Successfully');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function store_news_subscription(Request $request){
        $validator = Validator::make($request->all(), [
            'sub_email'=>'required|email|unique:subscriptions,email',
        ]);
        
        if($validator->fails()){
                return response()->json([
                'status_code' => 400,
                'response' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }else{
            $subscription = new Subscription();
            $subscription->email = $request->sub_email;
            $subscription->save();

            return response()->json([
                'status_code' => 200,
                'response' => 'success',
                'message' => "Newsletter Subscribed",
            ]);  
        }
    }
    public function store_enquiry(Request $request){
        $respArr = ["status"=>"","msg"=>""];
        
        $rules = [
            'contact_name'=>'required|string',
            'organizer_name'=>'required|string',
            'email'=>'required|email',
            'country_code'=>'required|string',
            'mob_no'=>'required|numeric|digits_between:4,12',
            'address'=>'required|string',
            'event_name'=>'required|string',
            'event_date'=>'required|date_format:d-m-Y',
            'tot_guests'=>'required|numeric|min:1',
            'event_payment_type' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            $respArr['status'] = 400;
            $respArr['msg'] = $validator->errors()->first();
        }else{

            $enquiry = new Enquiry();
            $enquiry->contact_name = $request->contact_name;
            $enquiry->organizer_name = $request->organizer_name;
            $enquiry->email = $request->email;
            $enquiry->country_code = $request->country_code;
            $enquiry->mob_no = $request->mob_no;
            $enquiry->address = $request->address;
            $enquiry->event_name = $request->event_name;
            $enquiry->event_date = date("Y-m-d",strtotime($request->event_date));
            $enquiry->tot_guests = $request->tot_guests;
            $enquiry->event_payment_type = $request->event_payment_type;
            $enquiry_details = $enquiry->save();

            $respArr['status'] = 200;
            $respArr['msg'] = "success";
        }
        return response()->JSON($respArr);
    }
    public function event_ticket_booking($slug){
        try{
            $data["event_details"] = Event::where(["slug"=>$slug,"status"=>"1"])->first();
            if(!empty($data["event_details"])){
                $ticket_categories = EventTicketDetail::where(["event_id"=>$data["event_details"]->id,["available_tickets",">","0"]])->get();
                TicketBookingCart::where(["user_id"=>auth()->user()->id])->delete();
                if(!empty($ticket_categories)){
                    foreach($ticket_categories as $ticket_category){
                        $ticket_booking = new TicketBookingCart();
                        $ticket_booking->user_id = auth()->user()->id;
                        $ticket_booking->event_ticket_id = $ticket_category->id;
                        $ticket_booking->event_id = $ticket_category->event_id;
                        $ticket_booking->no_of_tickets = 0;
                        $ticket_booking->save();
                    }
                }
                return redirect()->route('front.event_ticket_booking_cart');
            }else{
                return redirect()->route('front')->with('error','Invalid operation.');
            }
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }

    public function event_ticket_booking_cart(){
        try{
            $data["ticket_booking"] = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with("getEventDetails","getUserDetails",'getEventTicketDetails')->get();
            $slug = "";
            if(!empty($data["ticket_booking"])){
                foreach($data["ticket_booking"] as $bookings){
                    $slug = $bookings->getEventDetails->slug;
                }
            }

            $data["event_details"] = Event::where(["slug"=>$slug])->first();

            $data["other_events"] = DB::table('event_ticket_details')
                    ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
                    ->join('venues', 'events.venue_id', '=', 'venues.id')
                    ->select('events.*','venues.venue_name')
                    ->selectRaw('MIN(event_ticket_details.per_ticket_price) as `per_ticket_price`')
                    ->where("events.event_date",">",date("Y-m-d"))
                    ->where("events.status","=",1)
                    ->where("event_ticket_details.available_tickets",">","0")
                    ->where("events.slug","<>",$slug)
                    ->groupBy("event_ticket_details.event_id")
                    ->limit("3")
                    ->get();

            //$data["other_events"] = [];//Event::where([["slug","<>",$slug],['event_date','>',date('Y-m-d')]])->orderBy("event_date","ASC")->with('getVenue')->get()->toArray();
            $data["upcoming_events"] = DB::table('event_ticket_details')
                    ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
                    ->join('venues', 'events.venue_id', '=', 'venues.id')
                    ->select('events.*','venues.venue_name')
                    ->where("events.event_date",">",date("Y-m-d"))
                    ->where("events.status","=",1)
                    ->where("event_ticket_details.available_tickets",">","0")
                    ->where("events.slug","<>",$slug)
                    ->groupBy("event_ticket_details.event_id")
                    ->limit("3")
                    ->get();

            //$data["upcoming_events"] = Event::where([["event_date",">",date("Y-m-d")],'status'=>"1"])->orderBy("event_date","ASC")->take("3")->get();
            $data["tot_amt"] = Helper::get_total_cart_value();
            return view('front.user.event_ticket_booking',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function update_ticktet_booking(Request $request){
        $respArr = ["status"=>"","msg"=>""];
        if(isset($request->booking_id) && isset($request->no_of_tickets)){
            $booking_detail = TicketBookingCart::where(["id"=>$request->booking_id])->with('getEventDetails')->first();
            if(!empty($booking_detail)){
                $max_ticket_per_user = $booking_detail->getEventTicketDetails->max_ticket_per_user;
                if($max_ticket_per_user>=$request->no_of_tickets){
                    TicketBookingCart::where(["id"=>$request->booking_id])->update(["no_of_tickets"=>$request->no_of_tickets]);
                    $tot_ticket_amt = ($request->no_of_tickets * $booking_detail->getEventTicketDetails->per_ticket_price);
                    $tot_ticket_amt = '$'.number_format(($tot_ticket_amt),2,".",",");
                    $respArr = ["status"=>"success","msg"=>"Booking Updated","tot_ticket_amt"=>$tot_ticket_amt];
                }else{
                    $respArr = ["status"=>"fail","msg"=>"Invalid No. of tickets"];
                }
            }else{
                $respArr = ["status"=>"fail","msg"=>"Invalid Booking"];
            }
        }else{
            $respArr = ["status"=>"fail","msg"=>"Invalid Operation"];
        }
        echo json_encode($respArr);die;
    }
    public function get_cart_details(){
        $respArr = ["status"=>"","msg"=>""];
        
        $booking_details = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with('getEventDetails')->get();
        if(!empty($booking_details)){
            $tot_amt = Helper::get_total_cart_value();
            $respArr = ["status"=>"success","msg"=>"Total Amount updated","tot_amt"=>$tot_amt];
        }else{
            $respArr = ["status"=>"fail","msg"=>"Invalid Booking"];
        }
        echo json_encode($respArr);die;
    }
    public function my_tickets(){
        try{
            $data["bookings"] = TicketBooking::where(["user_id"=>auth()->user()->id])->orderBy("id","DESC")->paginate('3');
            $used_events = [];
            if(!empty($data["bookings"])){
                foreach($data["bookings"] as $booking){
                    $used_events[] = $booking->event_id;
                }
            }

            $data["other_events"] = DB::table('event_ticket_details')
                    ->join('events', 'event_ticket_details.event_id', '=', 'events.id')
                    ->join('venues', 'events.venue_id', '=', 'venues.id')
                    ->select('events.*','venues.venue_name')
                    ->selectRaw('MIN(event_ticket_details.per_ticket_price) as `per_ticket_price`')
                    ->where("events.event_date",">",date("Y-m-d"))
                    ->where("events.status","=",1)
                    ->where("event_ticket_details.available_tickets",">","0")
                    ->whereNotIn('events.id',$used_events)
                    ->groupBy("event_ticket_details.event_id")
                    ->limit("3")
                    ->get();

            return view('front.user.my_bookings',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function view_ticket($booking_id){
        try{
            $data["bookings"] = TicketBooking::where(["user_id"=>auth()->user()->id,"id"=>$booking_id])->with('getEventDetails')->first();
            return view('front.user.view_ticket',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function favourite_events(){
        try{
            $limit = 6;
            $data["list_events"] = Event::whereHas("getEventTickets",function($q){
                $q->where('available_tickets','>','0');
            })->whereHas("getEventLikes")->orderBy("event_date","DESC")->paginate($limit);
            return view('front.user.favourite_events',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function download_ticket($booking_id){
        try{
            $data["ticket_detail"] = TicketBooking::where(["id"=>$booking_id])->with('getEventDetails','getEventTicketDetails','getUsers')->first();
            $pdf = PDF::loadView('front.user.view_ticket',$data);
            return $pdf->download('ticket.pdf');
            // return view('front.user.view_ticket',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function send_invite_email(Request $request){
        $respArr = ["status"=>"","msg"=>""];
        try{
            $booking_id = $request->booking_id;
            $invite_name = $request->invite_name;
            $invite_email = $request->invite_email;
            if($booking_id!="" && $invite_name!="" && $invite_email!=""){
                // send an invite email
                $data = ['email' => $invite_email,'name' => $invite_name,'url'=>route('front.download_ticket',$booking_id)];
                Mail::send('emails.ticket_invite', $data, function ($message) use ($data){
                    $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                    $message->to($data["email"]);
                    $message->subject('TixFair: Invitation');
                });

                $invitation_log = new InvitationLog();
                $invitation_log->ticket_booking_id = $booking_id;
                $invitation_log->name = $invite_name;
                $invitation_log->email = $invite_email;
                $invitation_log->save();

                $respArr = ["status"=>"success","msg"=>"Mail Sent"];
            }else{
                $respArr = ["status"=>"fail","msg"=>"Please specify Name & Email"];
            }
        }catch(\Exception $e){
            $respArr = ["status"=>"fail","msg"=>$e];
        }
        echo json_encode($respArr); die;
    }
}
?>