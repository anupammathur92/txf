<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Country;
use App\User;
use App\Event;
use App\EventLike;
use App\Venue;
use App\VenueLike;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(){
        try{
            $data["user_details"] = auth()->user();
            $data["country_codes"] = Country::get();
            return view('front.profile',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function update_profile(Request $request){
        $validator = $request->validate([
            'full_name'     => 'required|string',
            'email'  => 'required|email|unique:users,email,'.auth()->user()->id,
            'country_code'  => 'required',
            'mob_no'     => 'required|numeric|digits_between:4,12',
            'dob'  => 'required|date_format:d-m-Y',
            'gender'  => 'required|string',
        ]);

        try{
            $validator["dob"] = date("Y-m-d",strtotime($validator["dob"]));
            $user_details = User::where(["id"=>auth()->user()->id])->update($validator);
            return redirect('front/profile')->with('success','User Profile Updated Successfully.');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function change_password(Request $request){

        $respArr = ["status"=>"fail","msg"=>""];
        $input = $request->all();

        if(isset($input["old_password"]) && isset($input["new_password"]) && isset($input["confirm_password"]) && $input["old_password"]!="" && $input["new_password"]!="" && $input["confirm_password"]!=""){

            $user_details = User::where(["id"=>auth()->user()->id])->first();
            
            //check if old password is same as in database
            if (Hash::check($input["old_password"],$user_details->password)) {
                
                // check if new password is not same as old password
                if (!Hash::check($input["new_password"],$user_details->password)) {
                    
                    // check if new password and confirm password are same
                    if ($input["new_password"]==$input["confirm_password"]) {

                        User::where(["id"=>auth()->user()->id])->update(["password"=>Hash::make($input["new_password"])]);
                        Session::flash('success', 'Password successfully updated.');
                        $respArr = ["status"=>"success","msg"=>"Password successfully updated."];
                    }else{
                        $respArr = ["status"=>"fail","msg"=>"New Password and Confirm Password do not match"];
                    }
                }else{
                    $respArr = ["status"=>"fail","msg"=>"Old Password and New Password can not be same."];
                }
            }else{
                $respArr = ["status"=>"fail","msg"=>"Please fill correct old password"];
            }
        }else{
            $respArr = ["status"=>"fail","msg"=>"Please fill all fields."];
        }
        echo json_encode($respArr);die;
    }
    public function update_event_like(Request $request){
        
        $respArr = ["status"=>"fail","msg"=>""];
        $event_details = Event::where(["id"=>$request->event_id])->first();

        if($event_details->status=="1"){
            if($request->status=="add"){
                $event_like = new EventLike();

                $event_like->user_id = auth()->user()->id;
                $event_like->event_id = $request->event_id;

                $event_like->save();
                $respArr = ["status"=>"success","msg"=>"Liked!!"];                
            }else{
                EventLike::where(['event_id'=>$request->event_id,"user_id"=>auth()->user()->id])->delete();

                $respArr = ["status"=>"success","msg"=>"Liked Removed!!"];   
            }
        }else{
            $respArr = ["status"=>"fail","msg"=>"Event is Inactive"];
        }
        echo json_encode($respArr);die;
    }
    public function update_venue_like(Request $request){
        
        $respArr = ["status"=>"fail","msg"=>""];
        $venue_details = Venue::where(["id"=>$request->venue_id])->first();

        if($venue_details->status=="1"){
            if($request->status=="add"){
                $venue_like = new VenueLike();

                $venue_like->user_id = auth()->user()->id;
                $venue_like->venue_id = $request->venue_id;

                $venue_like->save();
                $respArr = ["status"=>"success","msg"=>"Liked!!"];                
            }else{
                VenueLike::where(['venue_id'=>$request->venue_id,"user_id"=>auth()->user()->id])->delete();

                $respArr = ["status"=>"success","msg"=>"Liked Removed!!"];   
            }
        }else{
            $respArr = ["status"=>"fail","msg"=>"Venue is Inactive"];
        }
        echo json_encode($respArr);die;
    }
}
?>