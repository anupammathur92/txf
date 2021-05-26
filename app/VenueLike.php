<?php
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class VenueLike extends Authenticatable
{
	protected $table = 'venue_likes';

    protected $fillable = [
        'venue_id','user_id'
    ];

    public function getUserDetails(){
    	return $this->belongsTo("App\User","user_id","id");
    }
    public function getVenueDetails(){
    	return $this->belongsTo("App\Venue","venue_id","id");
    }
}
?>