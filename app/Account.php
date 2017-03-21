<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Notifiable;

	protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $table = 'accounts';
}
