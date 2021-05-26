<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Payment extends Authenticatable
{
	protected $table = 'payments';

    public function getUserDetails(){
    	return $this->belongsTo("App\User","user_id","id");
    }
}
