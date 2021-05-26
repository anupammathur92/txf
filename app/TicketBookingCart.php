<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class TicketBookingCart extends Authenticatable
{
    protected $table = 'ticket_booking_cart';

    public function getEventDetails(){
    	return $this->belongsTo("App\Event","event_id","id");
    }
    public function getUserDetails(){
    	return $this->belongsTo("App\User","user_id","id");
    }
    public function getEventTicketDetails(){
    	return $this->belongsTo("App\EventTicketDetail","event_ticket_id","id");
    }
}
