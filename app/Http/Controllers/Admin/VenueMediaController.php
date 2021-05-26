<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Venue;
use App\VenueMedia;

class VenueMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($venue_id){
        try{
            $data["venue_id"] = $venue_id;
            $data["venue_medias"] = VenueMedia::where(["venue_id"=>$venue_id])->orderBy("id","DESC")->get();
            return view('admin.venue.media.list_venue_media',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($venue_id)
    {
        try{
            $data["venue_id"] = $venue_id;
            return view('admin.venue.media.add_venue_media',$data);
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
            'venue_id' => 'required|numeric',
            'media_type' => 'required|string',
            //'video_embed_code' => 'required|string',
            'venue_logo'=>'required|image'
        ]);

        try{
            $input = $request->all();
            $venue_logo = "";

            if($request->hasFile('venue_logo')){
                $file = $request->file('venue_logo');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $venue_logo = $file->storeAs('public/venue_logo',$file_name);
                $venue_logo = "venue_logo/".$file_name;
            }

            $venue_media = new VenueMedia();
            $venue_media->venue_id = $request->venue_id;
            $venue_media->media_type = $request->media_type;
            //$venue_media->video_embed_code = $request->video_embed_code;
            if($venue_logo!=""){
                $venue_media->image_media = $venue_logo;
            }

            $venue_media_details = $venue_media->save();

            return redirect('admin/list-venue-media/'.$request->venue_id)->with('success','Venue Media Added Successfully.');            
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
    public function edit($venue_id,$id){
        try{
            $data["venue_id"] = $venue_id;
            $data["venue_media_details"] = VenueMedia::where(["id"=>$id])->first();
            return view('admin.venue..media.edit_venue_media',$data);
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
            'venue_id' => 'required|numeric',
            'media_type' => 'required|string',
            'video_embed_code' => 'required'
        ]);

        try{

            /*if($request->hasFile('venue_logo')){
                $file = $request->file('venue_logo');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $venue_logo = $file->storeAs('public/venue_logo',$file_name);
                $update_arr["venue_logo"] = "venue_logo/".$file_name;
            }*/

            $update_arr["media_type"] = $request->media_type;
            $update_arr["video_embed_code"] = $request->video_embed_code;

            $venue_details = VenueMedia::where(["id"=>$request->update_id,"venue_id"=>$request->venue_id])->update($update_arr);
            return redirect('admin/list-venue-media/'.$request->venue_id)->with('success','Venue Media Updated Successfully.');
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
    public function destroy($venue_id,$id)
    {
        try{
            VenueMedia::where(["id"=>$id,"venue_id"=>$venue_id])->delete();
            return redirect('admin/list-venue-media/'.$venue_id)->with('success','Venue Media Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_venue_status($id){
        try{
            $venue_details = Venue::where(["id"=>$id])->first();
            if($venue_details->status==0){
                $status = 1;
            }else{
                $status = 0;
            }

            $venue_details->status = $status;
            $venue_details->save();
            return redirect('admin/list-venue')->with('success','Venue Status Updated Successfully.');
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