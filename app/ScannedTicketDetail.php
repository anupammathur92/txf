<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ScannedTicketDetail extends Authenticatable
{
    public function getBookingDetails(){
        return $this->belongsTo('App\TicketBooking','booking_id','id');
    }
    public function getUserDetails(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function getTicketCategoryDetails(){
        return $this->belongsTo('App\TicketCategory','ticket_category_id','id');
    }
}
