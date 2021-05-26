<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Artist extends Authenticatable
{
	use Sluggable;
    protected $fillable = [
        'artist_name','artist_bio','slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'artist_name'
            ]
        ];
    }

    public function getGenreDetails(){
        return $this->hasOne('App\Genre','id','genre_id');
    }
    public function getArtistEvents(){
        return $this->belongsToMany("App\Event","event_artists","artist_id","event_id");
    }
}
