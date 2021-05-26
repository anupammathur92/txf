<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Authenticatable
{
	use Sluggable;
    protected $fillable = [
        'category_name','slug'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }
    public function getevent(){
        return $this->hasMany("App\Event","category_id","id");
    }
}

