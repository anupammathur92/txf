<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Category;
use App\Country;
use App\ContactUs;
use App\Enquiry;
use App\Payment;
use App\TicketBooking;
use App\TicketCategory;
use App\Subscription;
use Hash;
use DB;

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
    public function dashboard(){
        try{
            return view('admin.dashboard');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function list_user(){
        try{
            return view('admin.user.list_user');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function index(){
        try{
            $data["users"] = User::where(["role_id"=>"2"])->orderBy("id","desc")->get();
            return view('admin.user.list_user',$data);
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
            $data["country_codes"] = Country::get();
            return view('admin.user.add_user',$data);
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
            'full_name'     => 'required|string',
            'email'  => 'required|email|unique:users',
            'country_code'  => 'required',
            'mob_no'     => 'required|numeric|digits_between:4,12',
            'dob'  => 'required|date_format:d-m-Y',
            'gender'  => 'required|string',
        ]);

        try{
            $user = new User();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->role_id = "2";
            $user->status = "1";
            $user->is_email_verified = "1";
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->country_code = $request->country_code;
            $user->mob_no = $request->mob_no;
            $user->dob = date("Y-m-d",strtotime($request->dob));
            $user->gender = $request->gender;
            $user->password = Hash::make('123456');

            $user_details = $user->save();
            
            return redirect('admin/list-user')->with('success','User Added Successfully.');
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
            $data["user_details"] = User::where(["id"=>$id])->first();
            return view('admin.user.show_user',$data);
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
            $data["country_codes"] = Country::get();
            $data["user_details"] = User::where(["id"=>$id])->first();
            return view('admin.user.edit_user',$data);
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
            'full_name'     => 'required|string',
            'email'  => 'required|email|unique:users,email,'.$request->update_id,
            'country_code'     => 'required',
            'mob_no'     => 'required|numeric|digits_between:4,12',
            'dob'  => 'required|date_format:d-m-Y',
            'gender'  => 'required|string',
        ]);
        try{
            $validator["dob"] = date("Y-m-d",strtotime($validator["dob"]));
            $user_details = User::where(["id"=>$request->update_id])->update($validator);
            return redirect('admin/list-user')->with('success','User Updated Successfully.');
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
            User::where(["id"=>$id])->delete();
            return redirect('admin/list-user')->with('success','User Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_user_status($id){
        try{
            $user_details = User::where(["id"=>$id])->first();
            if($user_details->status==0){
                $status = 1;
            }else{
                $status = 0;
            }

            $user_details->status = $status;
            $user_details->save();
            return redirect('admin/list-user')->with('success','User Status Updated Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function profile($id){
        try{
            $data["user_details"] = User::where(["id"=>$id])->first();
            return view('admin.user.profile',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function list_contact_us(){
        try{
            $data["list_contact_us"] = ContactUs::orderBy("id","DESC")->get();
            return view('admin.user.list_contact_us',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function show_contact_us($id){
        try{
            $data["contact_us_detail"] = ContactUs::where(["id"=>$id])->first();
            return view('admin.user.show_contact_us',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function list_enquiry(){
        try{
            $data["list_enquiries"] = Enquiry::orderBy("id","DESC")->get();
            return view('admin.user.list_enquiry',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function show_enquiry($id){
        try{
            $data["enquiry_detail"] = Enquiry::where(["id"=>$id])->first();
            return view('admin.user.show_enquiry',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function list_payment(){
        try{
            $data["list_payments"] = Payment::orderBy("id","DESC")->get();
            return view('admin.user.list_payment',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function export_users(Request $request){
        $validator = $request->validate([
            'event_date_ranges' => 'required'
        ],[
            'event_date_ranges.required'=>'The field is required.'
        ]);
        if($request->event_date_ranges){
            $date_range = explode(" _ ",$request->event_date_ranges);
            $event_query_start=date('Y-m-d',strtotime($date_range[0]));
            $event_query_end=date('Y-m-d',strtotime($date_range[1]));
        }
        $users = User::where(["role_id"=>"2"])->whereBetween('created_at', [$event_query_start, $event_query_end])->get();

        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');

        // do not cache the file
        header('Pragma: no-cache');
        header('Expires: 0');

        // create a file pointer connected to the output stream
        $file = fopen('php://output', 'w');

        fputcsv($file, array('Full Name', 'Email', 'Mobile No.', 'Gender', 'Status'));

        if(!empty($users)){
            foreach($users as $user){
                $mob_no = $user->country_code." ".$user->mob_no;
                $gender = ucfirst($user->gender);
                $status = ($user->status==0) ? "Inactive" : "Active";
                $row = [$user->full_name,$user->email,$mob_no,$gender,$status];
                fputcsv($file, $row);
            }
        }
        exit;
    }

    public function show_export_user()
    {
       return view('admin.show_user_export');
    }
    public function show_export_bookings(){
        try{
            //$data["categories"] = TicketCategory::orderBy("id","DESC")->get();
            $data["categories"] = Category::orderBy("id","DESC")->get();
            $data["users"] = User::where([["role_id","=","2"]])->orderBy("id","DESC")->get();
            return view('admin.show_export_bookings',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function export_bookings(Request $request){
        try{
            $data=$request->all();
            $cid=$request->category_id;
            if($request->event_date_ranges){
                $date_range = explode(" _ ",$request->event_date_ranges);
                $dat_start=date('Y-m-d',strtotime($date_range[0]));
                $date_end=date('Y-m-d',strtotime($date_range[1]));
            }
             
          //  $bookings = TicketBooking::with("getEventDetails","getUserDetails");
         
          $bookings = Category::with(['getevent.getticketbook' => function($q) use($dat_start, $date_end){
           $q->whereBetween('created_at',[$dat_start,$date_end]);
          }])->where('id', '=',$cid);
            // if(isset($request->user_id) && $request->user_id!=""){
            //     $bookings = $bookings->where(["user_id"=>$request->user_id]);
            // }
            // if(isset($request->ticket_category_id) && $request->ticket_category_id!=""){
            //     $bookings->whereHas("getEventTicketDetails.getTicketCategory",function($q)use($request){
            //         $q->where("id","=",$request->ticket_category_id);
            //     });
            // }

            $bookings = $bookings->get();

          

//$event_name = $booking->getevent->event_name;
                    //$user_name = 'akash';
                    //$tickets = $booking->getevent->getticketbook->no_of_tickets;
                    //$ticket_price = $$booking->getevent->getticketbook->per_ticket_price;
                   // $total_amt = ($tickets * $ticket_price);

                    //$row = [$event_name,$user_name,$tickets,$ticket_price,$total_amt];
                    //fputcsv($file, $row);
                //}
            //}

           // dd('fdf');

            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="bookings.csv"');

            // do not cache the file
            header('Pragma: no-cache');
            header('Expires: 0');

            // create a file pointer connected to the output stream
            $file = fopen('php://output', 'w');

            fputcsv($file, array('Date','Event Name', 'Tickets', 'Ticket Price($)', 'Total Amount($)'));
            if(!empty($bookings)){
                foreach($bookings as $booking){

                    foreach($booking->getevent as $val){
                       
                        $event_name = $val->event_name;

                        foreach($val->getticketbook as $val1){

                            $tickets = $val1->no_of_tickets;
                            $ticket_price = $val1->per_ticket_price;
                            $total_amt = ($tickets * $ticket_price);
                            $date=date('d-m-y',strtotime($val1->created_at));

                            $row = [$date,$event_name,$tickets,$ticket_price,$total_amt];
                            fputcsv($file, $row);

                        }
                    }

                    }
            }
            exit;
        }catch(\Exception $e){
            return redirect()->route('admin.show_export_bookings')->with('error','Something went wrong.');
        }
    }
    public function financial_summary(){
        try{
            $sql = "select (tot_sum -tot_comm) as `revenue_gen`,`for_range` from 
                ( 
                    SELECT SUM(tot_amount) as `tot_sum`,
                    SUM(admin_comm_val) as `tot_comm`,
                     CONCAT(YEAR(`created_at`),'-',MONTH(`created_at`)) as `for_range` 
                    FROM `ticket_bookings` 
                    group by YEAR(`created_at`),MONTH(`created_at`)
                ) as `a`";

            $data["revenues"] = DB::select($sql);
            return view('admin.financial_summary',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    public function subscribelist(){
        try{
            $data=Subscription::orderBy("id","DESC")->get();
            return view('admin.user.subscription',compact('data'));
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
}
?>