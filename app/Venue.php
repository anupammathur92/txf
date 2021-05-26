<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Venue extends Authenticatable
{
	use Sluggable;
    protected $fillable = [
        'venue_name','venue_address','status','slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'venue_name'
            ]
        ];
    }
    public function getVenueImages(){
        return $this->hasMany('App\VenueMedia', 'venue_id')->where(['media_type'=>'image']);
    }
    public function getVenueVideos(){
        return $this->hasMany('App\VenueMedia', 'venue_id')->where(['media_type'=>'video']);
    }
    public function getVenueEvents(){
        return $this->hasMany('App\Event', 'venue_id');
    }
}