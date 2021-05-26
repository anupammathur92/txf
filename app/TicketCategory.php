<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class TicketCategory extends Authenticatable
{
    use Sluggable;
    use Notifiable;

    protected $fillable = [
        'ticket_category_name'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'ticket_category_name'
            ]
        ];
    }
}