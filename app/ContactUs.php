<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ContactUs extends Authenticatable
{
    protected $table = 'contact_us';
    protected $fillable = [
        'full_name','email',
    ];
}
?>