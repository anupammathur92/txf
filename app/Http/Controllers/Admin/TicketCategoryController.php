<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\TicketCategory;
use App\EventTicketDetail;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data["ticket_categories"] = TicketCategory::orderBy("id","DESC")->get();
            return view('admin.ticket_category.list_ticket_category',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('admin.ticket_category.add_ticket_category');
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
            'ticket_category_name' => 'required|string|unique:ticket_categories,ticket_category_name',
        ]);

        try{
            $ticket_category = new TicketCategory();
            $ticket_category->ticket_category_name = $request->ticket_category_name;
            $ticket_category = $ticket_category->save();
            
            return redirect('admin/list-ticket-category')->with('success','Ticket Category Added Successfully.');
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
            $data["ticket_category_details"] = TicketCategory::where(["id"=>$id])->first();
            return view('admin.ticket_category.show_ticket_category',$data);
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
    public function edit($id)
    {
        try{
            $data["ticket_category_details"] = TicketCategory::where(["id"=>$id])->first();
            return view('admin.ticket_category.edit_ticket_category',$data);            
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
            'ticket_category_name'     => 'required|unique:ticket_categories,ticket_category_name,'.$request->update_id,
        ]);

        try{
            $event_count = EventTicketDetail::where(["ticket_category_id"=>$request->update_id])->count();
            
            if($event_count>0){
                return redirect('admin/list-ticket-category')->with('error','Ticket Category is in use with event');
            }

            $update_arr["ticket_category_name"] = $request->ticket_category_name;

            $ticket_category_details = TicketCategory::where(["id"=>$request->update_id])->update($update_arr);
            return redirect('admin/list-ticket-category')->with('success','Ticket Category Updated Successfully.');
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
    public function destroy($id)
    {
        try{
            $event_count = EventTicketDetail::where(["ticket_category_id"=>$id])->count();
            
            if($event_count>0){
                return redirect('admin/list-ticket-category')->with('error','Ticket Category is in use with event');
            }
            TicketCategory::where(["id"=>$id])->delete();
            return redirect('admin/list-ticket-category')->with('success','Ticket Category Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_ticket_category_status($id){
        try{
            $ticket_category_details = TicketCategory::where(["id"=>$id])->first();

            if(!empty($ticket_category_details)){

            $event_count = EventTicketDetail::where(["ticket_category_id"=>$id])->count();
            
            if($event_count>0){
                return redirect('admin/list-ticket-category')->with('error','Ticket Category is in use with event');
            }

            if($ticket_category_details->status==0){
                $status = 1;
            }else{
                $status = 0;
            }

            $ticket_category_details->status = $status;
            $ticket_category_details->save();
            return redirect('admin/list-ticket-category')->with('success','Ticket Category Status Updated Successfully.');
            }else{
                return redirect('admin/list-ticket-category')->with('error','Invalid Operation.');
            }
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
}
?>