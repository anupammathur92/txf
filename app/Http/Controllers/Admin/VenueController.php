<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Venue;
use App\Event;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data["venues"] = Venue::orderBy("id","DESC")->get();
            return view('admin.venue.list_venue',$data);            
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
            return view('admin.venue.add_venue');
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
    public function store(Request $request)
    {
        $validator = $request->validate([
            'venue_name' => 'required|string|unique:venues',
            'venue_address' => 'required|string',
            'digital_venue_address' => 'nullable|string',
            'venue_logo' => 'required|image|dimensions:max_height=60,max_width=90',
            'venue_header_image' => 'required|image|dimensions:max_height=340,max_width=540'
        ]);

        try{
            $input = $request->all();
            $venue_logo = "";
            $venue_header_image = "";

            if($request->hasFile('venue_logo')){
                $file = $request->file('venue_logo');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/venue_logo',$file_name);
                $venue_logo = "venue_logo/".$file_name;
            }

            if($request->hasFile('venue_header_image')){
                $file = $request->file('venue_header_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/venue_header_image',$file_name);
                $venue_header_image = "venue_header_image/".$file_name;
            }

            $venue = new Venue();
            $venue->venue_name = $request->venue_name;
            $venue->venue_address = $request->venue_address;
            $venue->digital_venue_address = $request->digital_venue_address;
            $venue->venue_logo = $venue_logo;
            $venue->venue_header_image = $venue_header_image;
            $venue_details = $venue->save();
            
            return redirect('admin/list-venue')->with('success','Venue Added Successfully.');            
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
            $data["venue_details"] = Venue::where(["id"=>$id])->first();
            return view('admin.venue.show_venue',$data);
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
            $data["venue_details"] = Venue::where(["id"=>$id])->first();
            return view('admin.venue.edit_venue',$data);
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
            'venue_name' => 'required|string|unique:venues,venue_name,'.$request->update_id,
            'venue_address' => 'required|string',
            'digital_venue_address' => 'nullable|string',
            'venue_logo' => 'image|dimensions:max_height=40,max_width=60',
            'venue_header_image' => 'image|dimensions:max_height=240,max_width=440'
        ]);
        try{

            $event_count = Event::where(["venue_id"=>$request->update_id])->count();
            
            if($event_count>0){
                return redirect('admin/list-venue')->with('error','Venue is assigned to Event.');
            }

            if($request->hasFile('venue_logo')){
                $file = $request->file('venue_logo');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/venue_logo',$file_name);
                $update_arr["venue_logo"] = "venue_logo/".$file_name;
            }

            if($request->hasFile('venue_header_image')){
                $file = $request->file('venue_header_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/venue_header_image',$file_name);
                $update_arr["venue_header_image"] = "venue_header_image/".$file_name;
            }

            $update_arr["venue_name"] = $request->venue_name;
            $update_arr["venue_address"] = $request->venue_address;
            $update_arr["digital_venue_address"] = $request->digital_venue_address;

            $venue_details = Venue::where(["id"=>$request->update_id])->update($update_arr);
            return redirect('admin/list-venue')->with('success','Venue Updated Successfully.');
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
            $event_count = Event::where(["venue_id"=>$id])->count();
            
            if($event_count>0){
                return redirect('admin/list-venue')->with('error','Venue is assigned to Event.');
            }
            
            Venue::where(["id"=>$id])->delete();
            return redirect('admin/list-venue')->with('success','Venue Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_venue_status($id){
        try{
            $venue_details = Venue::where(["id"=>$id])->first();
            if(!empty($venue_details)){
                $event_count = Event::where(["venue_id"=>$id])->count();
                if($event_count==0){
                    if($venue_details->status==0){
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                    $venue_details->status = $status;
                    $venue_details->save();
                    return redirect('admin/list-venue')->with('success','Venue Status Updated Successfully.');
                }else{
                    return redirect('admin/list-venue')->with('error','Venue is assigned to event.');
                }
            }else{
                return redirect('admin/list-venue')->with('error','Invalid Operation.');
            }
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function list_venue_media($id){
        return view('admin.venue.list_venue_media');
    }
    public function venue_media($id){
        $data["venue_id"] = $id;
        return view('admin.venue.add_venue_media',$data);
    }
}
?>