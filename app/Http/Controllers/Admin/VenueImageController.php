<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Venue;
use App\VenueMedia;

class VenueImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($venue_id){
        try{
            $data["venue_id"] = $venue_id;
            $data["venue_images"] = VenueMedia::where(["venue_id"=>$venue_id,"media_type"=>"image"])->orderBy("id","DESC")->get();
            return view('admin.venue.media.list_venue_image',$data);
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
            return view('admin.venue.media.add_venue_image',$data);
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
            'venue_image'=>'required|image'
        ]);

        try{
            $venue_logo = "";

            if($request->hasFile('venue_image')){
                $file = $request->file('venue_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/venue/venue_image',$file_name);
                $venue_image = "venue/venue_image/".$file_name;
            }

            $venue_media = new VenueMedia();
            $venue_media->venue_id = $request->venue_id;
            $venue_media->media_type = "image";
            $venue_media->image_media = $venue_image;

            $venue_media_details = $venue_media->save();

            return redirect('admin/list-venue-image/'.$request->venue_id)->with('success','Venue Image Added Successfully.');
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
            $data["venue_image_details"] = VenueMedia::where(["id"=>$id,"media_type"=>"image"])->first();
            return view('admin.venue..media.edit_venue_image',$data);
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
            'venue_image'=>'required|image'
        ]);

        try{
            $file = $request->file('venue_image');
            $originalname = $file->getClientOriginalName();
            $file_name = time()."_".$originalname;
            $file->move('public/uploads/venue/venue_image',$file_name);
            $update_arr["image_media"] = "venue/venue_image/".$file_name;

            $venue_video_details = VenueMedia::where(["id"=>$request->update_id,"venue_id"=>$request->venue_id])->update($update_arr);
            return redirect('admin/list-venue-image/'.$request->venue_id)->with('success','Venue Image Updated Successfully.');
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
            VenueMedia::where(["id"=>$id,"venue_id"=>$venue_id,"media_type"=>"image"])->delete();
            return redirect('admin/list-venue-image/'.$venue_id)->with('success','Venue Image Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
}
?>