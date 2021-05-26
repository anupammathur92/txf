<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Event;
use App\TicketBooking;
use App\ScannedTicketDetail;

class TicketController extends Controller
{
    public function getEventDetails(Request $request){
        $validatorRules = [
            'booking_id' => 'required|numeric|exists:ticket_bookings,id',
        ];
        try {
            $validator = Validator::make($request->all(), $validatorRules);
            if ($validator->fails()){
                $error = $validator->messages()->first();
                return response()->json(['status' => false, 'message' => $error]);
            }else{
                $booking_data = TicketBooking::where(["id"=>$request->booking_id])->with("getEventDetails","getUserDetails")->first();
                $resp_data = ["event_id"=>$booking_data->getEventDetails->id,
                              "event_name"=>$booking_data->getEventDetails->event_name,
                              "venue_id"=>$booking_data->getEventDetails->getVenue->id,
                              "venue_name"=>$booking_data->getEventDetails->getVenue->venue_name,
                              "ticket_category_id"=>$booking_data->getEventTicketDetails->getTicketCategory->id,
                              "ticket_category_name"=>$booking_data->getEventTicketDetails->getTicketCategory->ticket_category_name,
                              "tot_tickets"=>$booking_data->no_of_tickets,
                              "user_name"=>$booking_data->getUserDetails->full_name,
                              "event_logo_url"=>asset('public/uploads/'.$booking_data->getEventDetails->event_logo)
                            ];
                $message = "Success";
                $response = ['status'=>true, 'data'=>$resp_data];
                return response()->json($response);
            }
        } catch (\Exception $e) {
            $data = [];
            return response()->json(['status'=>false,'message'=>$e->getMessage(),'data'=>$data]);
        }
    }
    public function saveCheckIn(Request $request){
        $validatorRules = [
            'booking_id' => 'required',
        ];
        try{
            $validator = Validator::make($request->all(), $validatorRules);
            if($validator->fails()){
                $error = $validator->messages()->first();
                return response()->json(['status' => false, 'message' => $error]);
            }else{
                $booking_data = TicketBooking::where(["id"=>$request->booking_id])->first();
                $scanned_count = ScannedTicketDetail::where(["booking_id"=>$request->booking_id])->count();

                if($scanned_count<$booking_data["no_of_tickets"]){
                    $scan_detail = new ScannedTicketDetail();
                    $scan_detail->event_id = $booking_data->event_id;
                    $scan_detail->booking_id = $request->booking_id;
                    $scan_detail->ticket_category_id = $booking_data->getEventTicketDetails->ticket_category_id;
                    $scan_detail->user_id = $booking_data->user_id;
                    $scan_detail->save();

                    $message = "Scan Successful";

                }else{
                    $message = "Scan limit maxed out";
                }

                $response = ['status'=>true,'message'=>$message,'data'=>[]];
                return response()->json($response);
            }
        }catch(\Exception $e){
            $data = [];
            return response()->json(['status'=>false,'message'=>$e->getMessage(),'data'=>$data]);
        }
    }
    public function getCheckedInUser(Request $request){
        $validatorRules = [
            'event_id' => 'required',
        ];
        try{
            $validator = Validator::make($request->all(), $validatorRules);
            if($validator->fails()){
                $error = $validator->messages()->first();
                return response()->json(['status' => false, 'message' => $error]);
            }else{
                $event_data = Event::where(["id"=>$request->event_id])->first();
                $scanned_users = ScannedTicketDetail::where(["event_id"=>$request->event_id])->with("getBookingDetails","getUserDetails","getTicketCategoryDetails")->latest()->get();
                $resp_data = ["event_id"=>$event_data->id,
                              "event_name"=>$event_data->event_name,
                              "event_time"=>date('D, j M Y',strtotime($event_data->event_date))." ".$event_data->event_time, //$event_data->event_time,
                              "venue_id"=>$event_data->venue_id,
                              "venue_name"=>$event_data->getVenue->venue_name,
                              "event_logo_url"=>asset('public/uploads/'.$event_data->event_logo)
                            ];
                if(!empty($scanned_users)){
                    foreach($scanned_users as $scan_user){
                        $resp_data["scanned_users"][] = ["user_name"=>$scan_user->getUserDetails->full_name,
                                        "ticket_category_name"=>$scan_user->getTicketCategoryDetails->ticket_category_name,
                                        "created_time"=>date('H:i A',strtotime($scan_user->created_at))
                        ];
                    }
                }

                $response = ['status'=>true, 'data'=>$resp_data];
                return response()->json($response);
            }
        }catch(\Exception $e){
            $data = [];
            return response()->json(['status'=>false,'message'=>$e->getMessage(),'data'=>$data]);
        }
    }
}//end class.