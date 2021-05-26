<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Country;
use App\User;
use Helper;
use Auth;
use Hash;
use DB;

class LoginController extends Controller
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
    public function index(){
        try{
            return view('front.login.login');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function create(){
        try{
            $data["country_codes"] = Country::get();
            return view('front.login.register',$data);
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function store(Request $request){

        $validator = $request->validate([
            'full_name'     => 'required|string',
            'email'  => 'required|email|unique:users',
            'password'  => 'required',
            'confirm_password'  => 'required|same:password',
            'country_code'  => 'required',
            'mob_no'     => 'required|numeric|digits_between:4,12',
            'dob'  => 'required|date_format:d-m-Y',
            't_c'  => 'required|numeric',
        ],[
            't_c.required'=>'T&C agreement is required'
        ]);

        try{

            $otp = Helper::generateOTP(6);
            $token = Helper::str_random(64);

            $user = new User();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->role_id = "2";
            $user->status = "1";
            $user->country_code = $request->country_code;
            $user->mob_no = $request->mob_no;
            $user->dob = date("Y-m-d",strtotime($request->dob));
            $user->gender = $request->gender;
            $user->otp = $otp;
            $user->is_email_verified = 0;
            $user->status = 0;
            $user->token = $token;
            $user->password = Hash::make($request->password);
            $user_details = $user->save();

            $data = ['email' => $request->email,'url'=>route('front.verify_account',$token),'otp'=>$otp];
            Mail::send('emails.front_email_verification', $data, function ($message) use ($data){
                $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                $message->to($data["email"]);
                $message->subject('TixFair: Registration Email Verification');
            });

            return redirect()->route('front-login')->with('success','Email verification mail sent.');
        }catch(\Exception $e){
            return redirect()->route('front')->with('error','Something went wrong.');
        }
    }
    public function login(Request $request){
        $request->validate([
                'email' => 'required|email',
                'password' => 'required'
        ]);
        try{
            $remember = false;
            if($request->remember && $request->remember==1){
                $remember = true;
            }

            if(Auth::guard('front')->attempt(["email"=>$request->email,'password'=>$request->password,"role_id"=>"2","status"=>"1"],$remember)){
                return redirect()->intended(route('front'));
            }else{
                return redirect()->route('front-login')->with('error','Invalid Credentials');
            }
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function forgot_password(){
        try{
            return view('front.login.forgot_password');
        }catch(Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function send_verification_email(request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        try{
            $user_details = User::where(["email"=>$request->email])->first();

            if($user_details->role_id!=2 || $user_details->status!=1){
                return redirect()->back()->with('error', 'The selected email is invalid.');
            }
            $otp = Helper::generateOTP(6);
            $token = Helper::str_random(64);

            DB::table('password_resets')->insert(
                ['email' => $request->email, 'otp'=>$otp, 'token' => $token, 'created_at' => Carbon::now()]
            );

            $data = ['email' => $request->email,'otp'=>$otp,'url'=>route('front.reset_password',$token)];

            Mail::send('emails.front_password_reset', $data, function ($message) use ($data){
                $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                $message->to($data["email"]);
                $message->subject('TixFair: Reset Password Request');
            });

            return redirect()->route('front-login')->with('success', 'Password reset mail sent.');
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function reset_password($token){
        try{
            $data["token"] = $token;
            return view('front.login.reset_password',$data);
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function reset(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'otp' => 'required|numeric',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        try{
            $updatePassword = DB::table('password_resets')
                ->where(['email' => $request->email,'otp'=>$request->otp,'token' => $request->token])
                ->first();

            if(!$updatePassword)
                return back()->withInput()->with('error', 'Invalid data!');

            $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            return redirect()->route('front-login')->with('success','Your password has been updated!');
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function verify_account($token){
        try{
            $data["token"] = $token;
            return view('front.login.verify_email',$data);
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function verify_email(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'otp' => 'required',
        ]);

        try{
            $user_details = User::where(["email"=>$request->email,'otp'=>$request->otp,'token'=>$request->token])->first();

            if(empty($user_details)){
                return back()->withInput()->with('error', 'Invalid data');
            }

            User::where(["email"=>$request->email])->update(["otp"=>"","token"=>"","email_verified_at"=>date('Y-m-d H:i:s'),'is_email_verified'=>'1','status'=>'1']);
            return redirect()->route('front-login')->with('success','Email Verified');
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
    public function logout(){
        try{
            Auth::guard('front')->logout();
            return redirect()->route('front-login');
        }catch(\Exception $e){
            return redirect()->route('front-login')->with('error','Something went wrong.');
        }
    }
}
?>