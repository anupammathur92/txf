<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Venue;
use App\VenueMedia;

class VenueVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($venue_id){
        try{
            $data["venue_id"] = $venue_id;
            $data["venue_videos"] = VenueMedia::where(["venue_id"=>$venue_id,"media_type"=>"video"])->orderBy("id","DESC")->get();
            return view('admin.venue.media.list_venue_video',$data);
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
            return view('admin.venue.media.add_venue_video',$data);
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
            'video_embed_code' => 'required|string'
        ]);

        try{
            $input = $request->all();

            $venue_media = new VenueMedia();
            $venue_media->venue_id = $request->venue_id;
            $venue_media->media_type = "video";
            $venue_media->video_embed_code = $request->video_embed_code;

            $venue_media_details = $venue_media->save();

            return redirect('admin/list-venue-video/'.$request->venue_id)->with('success','Venue Video Added Successfully.');
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
            $data["venue_details"] = VenueMedia::where(["id"=>$id,"media_type"=>"video"])->first();
            return view('admin.venue.show_venue_video',$data);
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
            $data["venue_video_details"] = VenueMedia::where(["id"=>$id,"media_type"=>"video"])->first();
            return view('admin.venue..media.edit_venue_video',$data);
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
            'video_embed_code' => 'required|string'
        ]);

        try{
            $update_arr["video_embed_code"] = $request->video_embed_code;

            $venue_video_details = VenueMedia::where(["id"=>$request->update_id,"venue_id"=>$request->venue_id])->update($update_arr);
            return redirect('admin/list-venue-video/'.$request->venue_id)->with('success','Venue Video Updated Successfully.');
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
            VenueMedia::where(["id"=>$id,"venue_id"=>$venue_id,"media_type"=>"video"])->delete();
            return redirect('admin/list-venue-video/'.$venue_id)->with('success','Venue Video Deleted Successfully.');
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