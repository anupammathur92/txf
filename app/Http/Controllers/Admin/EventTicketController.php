<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Event;
use App\EventTicketDetail;
use App\TicketCategory;
use App\TicketBooking;

class EventTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id){
        try{
            $data["event_id"] = $event_id;
            $data["event_tickets"] = EventTicketDetail::where(["event_id"=>$event_id])->with("getTicketCategory","getEventDetail")->orderBy("id","DESC")->get();
            return view('admin.event.list_event_ticket',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id){
        try{
            $data["event_id"] = $event_id;
            $used_ticket_categories = EventTicketDetail::where(["event_id"=>$event_id])->pluck("ticket_category_id")->toArray();
            $ticketCatQuery = TicketCategory::where(["status"=>1]);
            if(!empty($used_ticket_categories)){
                $ticketCatQuery->whereNotIn("id",$used_ticket_categories);
            }
            $data["ticket_categories"] = $ticketCatQuery->get();
            return view('admin.event.add_event_ticket',$data);
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
            'ticket_category_id' => 'required|numeric',
            'total_tickets' => 'required|numeric|min:1',
            'max_ticket_per_user' => 'required|numeric|min:1|lte:total_tickets',
            'per_ticket_price' => 'required|numeric|min:1',
            'admin_comm' => 'required|numeric',
        ]);

        try{
            $event_ticket_detail = new EventTicketDetail();
            $event_ticket_detail->ticket_category_id = $request->ticket_category_id;
            $event_ticket_detail->event_id = $request->event_id;
            $event_ticket_detail->total_tickets = $request->total_tickets;
            $event_ticket_detail->max_ticket_per_user = $request->max_ticket_per_user;
            $event_ticket_detail->per_ticket_price = $request->per_ticket_price;
            $event_ticket_detail->available_tickets = $request->total_tickets;
            $event_ticket_detail->admin_comm = $request->admin_comm;
            $event_ticket_details = $event_ticket_detail->save();

            return redirect('admin/list-event-ticket/'.$request->event_id)->with('success','Ticket Details Added Successfully.');            
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
    public function show($id)
    {
        try{
            $data["event_ticket_details"] = EventTicketDetail::where(["id"=>$id])->first();
            return view('admin.event.show_event_ticket',$data);
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
    public function edit($event_id,$id){
        try{
            $data["event_id"] = $event_id;

            $used_ticket_categories = EventTicketDetail::where([["id","!=",$id],"event_id"=>$event_id])->pluck("ticket_category_id")->toArray();
            $ticketCatQuery = TicketCategory::where(["status"=>1]);
            //if(!empty($used_ticket_categories)){
                $ticketCatQuery->whereNotIn("id",$used_ticket_categories);
            //}
            $data["ticket_categories"] = $ticketCatQuery->get();

            $data["ticket_details"] = EventTicketDetail::where(["id"=>$id])->first();
            return view('admin.event.edit_event_ticket',$data);
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
    public function update(Request $request)
    {
        $validator = $request->validate([
            'ticket_category_id' => 'required|numeric',
            'total_tickets' => 'required|numeric|min:1',
            'max_ticket_per_user' => 'required|numeric|min:1|lte:total_tickets',
            'per_ticket_price' => 'required|numeric|min:1',
            'admin_comm' => 'required|numeric|min:1',
        ]);

        try{
            $booking_count = TicketBooking::where(["event_ticket_id"=>$request->update_id])->count();
            if($booking_count>0){
                return redirect('admin/list-event-ticket/'.$request->event_id)->with('error','Ticket exists in booking.');
            }
            $update_arr["ticket_category_id"] = $request->ticket_category_id;
            $update_arr["total_tickets"] = $request->total_tickets;
            $update_arr["max_ticket_per_user"] = $request->max_ticket_per_user;
            $update_arr["per_ticket_price"] = $request->per_ticket_price;
            $update_arr["available_tickets"] = $request->total_tickets;
            $update_arr["admin_comm"] = $request->admin_comm;

            $venue_details = EventTicketDetail::where(["id"=>$request->update_id,"event_id"=>$request->event_id])->update($update_arr);
            return redirect('admin/list-event-ticket/'.$request->event_id)->with('success','Event Ticket Updated Successfully.');
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
    public function destroy($event_id,$id)
    {
        try{
            $booking_count = TicketBooking::where(["event_ticket_id"=>$id])->count();
            if($booking_count>0){
                return redirect('admin/list-event-ticket/'.$event_id)->with('error','Ticket exists in booking.');
            }
            EventTicketDetail::where(["id"=>$id,"event_id"=>$event_id])->delete();
            return redirect('admin/list-event-ticket/'.$event_id)->with('success','Event Ticket Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
}
?>