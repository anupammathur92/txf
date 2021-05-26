<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Rules\CategoryActive;
use App\Rules\VenueActive;
use App\Rules\ArtistActive;
use App\Event;
use App\Venue;
use App\Category;
use App\Artist;
use App\EventArtist;
use App\TicketBooking;
use App\TicketBookingCart;
use DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $data["events"] = Event::orderBy("id","DESC")->get();
            return view('admin.event.list_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    public function completeindex(){
        try{
            $data['complete_event']= Event::where([["event_date","<",date("Y-m-d")],'status'=>"1",["event_end_time",">",date('H:i')]])
            ->orwhere("event_end_time","<",date('H:i'))->orderBy("id","DESC")->get();
           return view('admin.event.complete_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    public function inprocessindex(){
        try{
            $data['inprocess_event'] = DB::select("select * from events where event_date='".date('Y-m-d')."' AND event_end_time>='".date('H:i')."' AND event_time<='".date('H:i')."'");
           return view('admin.event.inprocess_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    public function upcomingindex(){
        try{
            $data['upcomingindex_event']= Event::where('event_date',">",date("Y-m-d"))->orderBy("id","DESC")->get();
           return view('admin.event.upcoming_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try{
            $data["venues"] = Venue::where(["status"=>"1"])->get();
            $data["categories"] = Category::where(["status"=>"1"])->get();
            $data["artists"] = Artist::where(["status"=>"1"])->get();
            return view('admin.event.add_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $validator = $request->validate([
            'event_name' => 'required|string|unique:events',
            'organizer' => 'string',
            'venue_id' => ['required','numeric',new VenueActive],
            'category_id' => ['required','numeric',new CategoryActive],
            'artist_id.*' => ['required','numeric','distinct',new ArtistActive],
            'event_date' => 'required|date_format:d-m-Y',
            'event_time' => 'required|string',
            'event_end_time' => 'required|string',
            'event_logo' => 'required|image|dimensions:max_height=60,max_width=90',
            'event_header_image' => 'required|image|dimensions:max_height=340,max_width=540',
            'description' => 'required|string'
        ],[
            'venue_id.required'=>'The venue name field is required.',
            'category_id.required'=>'The category name field is required.'
        ]);

        try{
            $event_logo = "";
            $event_header_image = "";

            if($request->hasFile('event_logo')){
                $file = $request->file('event_logo');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $event_logo = $file->move('public/uploads/event_logo/',$file_name);
                $event_logo = "event_logo/".$file_name;
            }

            if($request->hasFile('event_header_image')){
                $file = $request->file('event_header_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $event_header_image = $file->move('public/uploads/event_header_image/',$file_name);
                $event_header_image = "event_header_image/".$file_name;
            }

            $event = new Event();
            $event->event_name = $request->event_name;
            $event->organizer = $request->organizer;
            $event->venue_id = $request->venue_id;
            $event->category_id = $request->category_id;
            $event->event_header_image = $event_header_image;
            $event->event_logo = $event_logo;
            $event->event_date = date("Y-m-d",strtotime($request->event_date));
            $event->event_time = $request->event_time;
            $event->event_end_time = $request->event_end_time;
            $event->description = $request->description;
            $event_details = $event->save();
            $event_id = $event->id;

            $artists = $request->artist_id;
            if(!empty($artists)){
                foreach($artists as $artist){
                    $event_artist = new EventArtist();
                    $event_artist->event_id = $event_id;
                    $event_artist->artist_id = $artist;
                    $event_artist_details = $event_artist->save();
                }
            }

            return redirect('admin/upcoming-event')->with(['add_event_success'=>'Event Added Successfully.','success'=>'Event Added Successfully.']);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try{
            $data["event_details"] = Event::where(["id"=>$id])->with('getEventArtists')->first();
            return view('admin.event.show_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            $data["venues"] = Venue::where(["status"=>"1"])->get();
            $data["categories"] = Category::where(["status"=>"1"])->get();
            $data["artists"] = Artist::where(["status"=>"1"])->get();
            $data["event_details"] = Event::where(["id"=>$id])->with('getEventArtists')->first();

            $data["event_artists"] = [];
            if(!empty($data["event_details"]->getEventArtists)){
                foreach($data["event_details"]->getEventArtists as $evt_artist){
                    $data["event_artists"][] = $evt_artist->id;
                }
            }
            return view('admin.event.edit_event',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        $validator = $request->validate([
            'event_name' => 'required|string|unique:events,event_name,'.$request->update_id,
            'organizer' => 'string',
            'venue_id' => ['required','numeric',new VenueActive],
            'category_id' => ['required','numeric',new CategoryActive],
            'artist_id.*' => ['required','numeric','distinct',new ArtistActive],
            'event_date' => 'required|date_format:d-m-Y',
            'event_time' => 'required|string',
            'event_end_time' => 'required|string',
            'event_logo' => 'image|dimensions:max_height=40,max_width=60',
            'event_header_image' => 'image|dimensions:max_height=240,max_width=440',
            'description' => 'required|string'
        ],[
            'venue_id.required'=>'The venue name field is required.',
            'category_id.required'=>'The category name field is required.',
        ]);

        try{

            $ticket_booking_cart_count = TicketBookingCart::where(["event_id"=>$request->update_id])->count();
            if($ticket_booking_cart_count!=0){
                return redirect('admin/upcoming-event')->with('error','Event exists in cart');
            }

            $ticket_booking_count = TicketBooking::where(["event_id"=>$request->update_id])->count();
            if($ticket_booking_count!=0){
                return redirect('admin/upcoming-event')->with('error','Event Tickets have been booked');
            }

            if($request->hasFile('event_logo')){
                $file = $request->file('event_logo');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $event_logo = $file->move('public/uploads/event_logo/',$file_name);
                $update_arr["event_logo"] = "event_logo/".$file_name;
            }

            if($request->hasFile('event_header_image')){
                $file = $request->file('event_header_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $event_header_image = $file->move('public/uploads/event_header_image/',$file_name);
                $update_arr["event_header_image"] = "event_header_image/".$file_name;
            }

            $update_arr["event_name"] = $request->event_name;
            $update_arr["organizer"] = $request->organizer;
            $update_arr["venue_id"] = $request->venue_id;
            $update_arr["category_id"] = $request->category_id;
            $update_arr["event_date"] = date("Y-m-d H:i:s",strtotime($request->event_date));
            $update_arr["event_time"] = $request->event_time;
            $update_arr["event_end_time"] = $request->event_end_time;
            $update_arr["description"] = $request->description;

            $event_details = Event::where(["id"=>$request->update_id])->update($update_arr);
            
            $event_id = $request->update_id;

            EventArtist::where(["event_id"=>$event_id])->delete();

            $artists = $request->artist_id;
            if(!empty($artists)){
                foreach($artists as $artist){
                    $event_artist = new EventArtist();
                    $event_artist->event_id = $event_id;
                    $event_artist->artist_id = $artist;
                    $event_artist_details = $event_artist->save();
                }
            }

            return redirect('admin/upcoming-event')->with('success','Event Updated Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $ticket_booking_cart_count = TicketBookingCart::where(["event_id"=>$id])->count();

            if($ticket_booking_cart_count!=0){
                return redirect('admin/upcoming-event')->with('error','Event exists in cart');
            }
            $ticket_booking_count = TicketBooking::where(["event_id"=>$id])->count();

            if($ticket_booking_count!=0){
                return redirect('admin/upcoming-event')->with('error','Event Tickets have been booked');
            }
            Event::where(["id"=>$id])->delete();
            return redirect('admin/upcoming-event')->with('success','Event Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_event_status($id){
        try{
            $event_details = Event::where(["id"=>$id])->first();
            
            if(!empty($event_details)){
                $ticket_booking_cart_count = TicketBookingCart::where(["event_id"=>$id])->count();

                if($ticket_booking_cart_count!=0){
                    return redirect('admin/upcoming-event')->with('error','Event exists in cart');
                }
                $ticket_booking_count = TicketBooking::where(["event_id"=>$id])->count();

                if($ticket_booking_count!=0){
                    return redirect('admin/upcoming-event')->with('error','Event Tickets have been booked');
                }

                if($event_details->status==0){
                    $status = 1;
                }else{
                    $status = 0;
                }

                $event_details->status = $status;
                $event_details->save();
                return redirect('admin/upcoming-event')->with('success','Event Status Updated Successfully.');
            }else{
                return redirect('admin/upcoming-event')->with('error','Invalid Operation.');
            }
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_event_featured_status($id){
        try{
            $event_details = Event::where(["id"=>$id])->first();
            if($event_details->is_featured==0){
                $is_featured = 1;
            }else{
                $is_featured = 0;
            }

            $event_details->is_featured = $is_featured;
            $event_details->save();
            return redirect('admin/upcoming-event')->with('success','Event Featured Status Updated Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
}
?>