<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Authenticatable
{
    use Sluggable;
    protected $fillable = [
        'event_name','description','slug'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'event_name'
            ]
        ];
    }
    public function getCategory(){
    	return $this->belongsTo("App\Category","category_id","id");
    }
    public function getVenue(){
    	return $this->belongsTo("App\Venue","venue_id","id");
    }
    public function getEventArtists(){
    	return $this->belongsToMany("App\Artist","event_artists","event_id","artist_id");
    }
    public function getEventLikes(){
        return $this->hasMany("App\EventLike","event_id","id");
    }
    public function getEventTickets(){
        return $this->hasMany("App\EventTicketDetail","event_id","id");
    }
    public function getticketbooking(){
        return $this->belongsTo("App\TicketBooking","id","event_id");
    }

    public function getticketbook(){
        return $this->hasMany("App\TicketBooking","event_id","id");
    }
    
}
?>