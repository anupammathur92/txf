<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Artist;
use App\Genre;
use App\EventArtist;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data["artists"] = Artist::orderBy("id","DESC")->get();
            return view('admin.artist.list_artist',$data);
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
            $data["genres"] = Genre::get();
            return view('admin.artist.add_artist',$data);
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
            'artist_name' => 'required|string|unique:artists',
            'genre_id' => 'required|numeric',
            'artist_bio' => 'required|string',
            'artist_image' => 'required|image|dimensions:max_height=308,max_width=308'
        ]);

        try{
            $input = $request->all();
            $artist_image = "";

            if($request->hasFile('artist_image')){
                $file = $request->file('artist_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/artist',$file_name);
                $artist_image = "artist/".$file_name;
            }

            $artist = new Artist();
            $artist->artist_name = $request->artist_name;
            $artist->genre_id = $request->genre_id;
            $artist->artist_bio = $request->artist_bio;
            $artist->artist_image = $artist_image;
            $artist_details = $artist->save();
            
            return redirect('admin/list-artist')->with('success','Artist Added Successfully.');
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
            $data["artist_details"] = Artist::where(["id"=>$id])->first();
            return view('admin.artist.show_artist',$data);
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
            $data["genres"] = Genre::get();
            $data["artist_details"] = Artist::where(["id"=>$id])->first();
            return view('admin.artist.edit_artist',$data);            
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
            'artist_name' => 'required|string|unique:artists,artist_name,'.$request->update_id,
            'genre_id' => 'required|numeric',
            'artist_bio' => 'required|string',
            'artist_image' => 'image|dimensions:max_height=308,max_width=308'
        ]);

        try{
            $event_count = EventArtist::where(["artist_id"=>$request->update_id])->count();
            
            if($event_count>0){
                return redirect('admin/list-artist')->with('error','Artist is assigned to Event.');
            }

            if($request->hasFile('artist_image')){
                $file = $request->file('artist_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/artist',$file_name);
                $update_arr["artist_image"] = "artist/".$file_name;
            }

            $update_arr["artist_name"] = $request->artist_name;
            $update_arr["artist_bio"] = $request->artist_bio;
            $update_arr["genre_id"] = $request->genre_id;

            $artist_details = Artist::where(["id"=>$request->update_id])->update($update_arr);
            return redirect('admin/list-artist')->with('success','Artist Updated Successfully.');
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
            $event_count = EventArtist::where(["artist_id"=>$id])->count();
            
            if($event_count>0){
                return redirect('admin/list-artist')->with('error','Artist is assigned to Event.');
            }
            Artist::where(["id"=>$id])->delete();
            return redirect('admin/list-artist')->with('success','Artist Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_artist_status($id){
        try{
            $artist_details = Artist::where(["id"=>$id])->first();

            if(!empty($artist_details)){

                $event_artists_count = EventArtist::where(["artist_id"=>$id])->count();
                if($event_artists_count==0){
                    if($artist_details->status==0){
                        $status = 1;
                    }else{
                        $status = 0;
                    }

                    $artist_details->status = $status;
                    $artist_details->save();
                    return redirect('admin/list-artist')->with('success','Artist Status Updated Successfully.');
                }else{
                    return redirect('admin/list-artist')->with('error','Artist is assigned to event.');
                }
            }else{
                return redirect('admin/list-artist')->with('error','Invalid Operation.');
            }

        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_artist_popularity(Request $request){

        $validator = Validator::make($request->all(), [
            'artist_id' => 'required|exists:artists,id',
            'popularity_val' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status_code' => 400,
                'response' => 'fail',
                'message' => $validator->messages()->first(),
            ]);
        }

        try{
            $popularity_exists = Artist::where(["popularity_sequence"=>$request->popularity_val])->count();

            if($popularity_exists>0){
                return response()->json([
                    'status_code' => 400,
                    'response' => 'fail',
                    'message' => 'Popularity sequence already in use',
                ]);
            }

            Artist::where(['id'=>$request->artist_id])->update(["popularity_sequence"=>$request->popularity_val]);
            return response()->json([
                'status_code' => 200,
                'response' => 'success',
                'message' => 'Popularity sequence updated',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status_code' => 400,
                'response' => 'fail',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
?>