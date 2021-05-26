<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EventLike extends Authenticatable
{
	protected $table = 'event_likes';

    protected $fillable = [
        'event_id','user_id'
    ];

    public function getUserDetails(){
    	return $this->belongsTo("App\User","user_id","id");
    }
    public function getEventDetails(){
    	return $this->belongsTo("App\Event","event_id","id");
    }
}
