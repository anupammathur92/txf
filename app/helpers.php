<?php
namespace App\Helpers;
use App\User;
use App\Category;
use App\Country;
use App\Venue;
use App\Artist;
use App\Event;
use App\EventLike;
use App\VenueLike;
use App\TicketBookingCart;
use App\EventTicketDetail;

class Helper{

	public static function str_random(){
	    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	    $length = 64;
	    $token = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	    return $token;
	}
	public static function getCountries(){
		return Country::get();
	}
	public static function generateOTP($length) {
		$string		=	'0123456789';
		$strShuffled=	str_shuffle($string);
		$otp		=	substr($strShuffled, 1, $length);
		return $otp;
	}
	public static function getMinEventTicketPrice($event_id){
		$event_detail = Event::where(["id"=>$event_id])->first();
		if($event_detail["event_date"]<date("Y-m-d")){
			// this is a previous event
			$data = EventTicketDetail::where(["event_id"=>$event_id])->min("per_ticket_price");
		}else{
			// this is a upcoming event
			$data = EventTicketDetail::where(["event_id"=>$event_id,["available_tickets",">","0"]])->min("per_ticket_price");
		}
		
		return $data;
	}
	public static function get_users_count(){
		$total_count = User::where(["role_id"=>2])->count();
		return $total_count;
	}
	public static function get_categories_count(){
		$total_count = Category::count();
		return $total_count;
	}
	public static function get_venues_count(){
		$total_count = Venue::count();
		return $total_count;
	}
	public static function get_artists_count(){
		$total_count = Artist::count();
		return $total_count;
	}
	public static function get_events_count(){
		$total_count = Event::count();
		return $total_count;
	}
	public static function getEventArtistName($id){
		$artist_details = Artist::where(["id"=>$id])->first();
		return $artist_details->artist_name;
	}
	public static function IsLikedEvent($event_id){
		$is_liked_count = EventLike::where(["event_id"=>$event_id,"user_id"=>auth()->guard('front')->user()->id])->count();
		return $is_liked_count;
	}
	public static function IsLikedVenue($venue_id){
		$is_liked_count = VenueLike::where(["venue_id"=>$venue_id,"user_id"=>auth()->guard('front')->user()->id])->count();
		return $is_liked_count;
	}
	public static function pr($arr = []){
		echo "<pre>"; pr($arr); echo "</pre>";
	}
	public static function get_total_cart_value(){
        $booking_details = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with('getEventTicketDetails')->get();
        $tot_amt = 0;
        if(!empty($booking_details)){
            foreach($booking_details as $booking_detail){
                $tot_amt = $tot_amt + ($booking_detail->no_of_tickets * $booking_detail->getEventTicketDetails->per_ticket_price);
            }
            $tot_amt = '$'.number_format(($tot_amt),2,".",",");
        }
        return $tot_amt;
	}
	public static function get_total_cart_value_in_value(){
        $booking_details = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with('getEventTicketDetails')->get();
        $tot_amt = 0;
        if(!empty($booking_details)){
            foreach($booking_details as $booking_detail){
                $tot_amt = $tot_amt + ($booking_detail->no_of_tickets * $booking_detail->getEventTicketDetails->per_ticket_price);
            }
        }
        return $tot_amt;
	}
	public static function check_ticket_availability(){
		$cart_details = TicketBookingCart::where(["user_id"=>auth()->user()->id])->with('getEventTicketDetails')->get();
		if(!empty($cart_details)){
			$err = 0;
			foreach($cart_details as $cart_detail){
				if($cart_detail->no_of_tickets>$cart_detail->getEventTicketDetails->available_tickets){
					$err = 1;
					break;
				}
			}
		}
		if($err==1){
			return 0;
		}
		return 1;
	}
}
?>