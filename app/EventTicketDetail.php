<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EventTicketDetail extends Authenticatable
{
	protected $table = 'event_ticket_details';
    protected $fillable = [
        'event_id','ticket_category_id'
    ];

    public function getTicketCategory(){
    	return $this->belongsTo("App\TicketCategory","ticket_category_id","id");
    }
    public function getEventDetail(){
    	return $this->belongsTo("App\Event","event_id","id");
    }
}
