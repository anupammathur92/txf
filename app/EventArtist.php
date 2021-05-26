<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EventArtist extends Authenticatable
{
    protected $fillable = [
        'event_id','artist_id'
    ];

    public function getArtistDetails(){
    	return $this->belongsTo("App\Artist","artist_id","id");
    }
    public function getEventDetails(){
    	return $this->belongsTo("App\Event","event_id","id");
    }
}
