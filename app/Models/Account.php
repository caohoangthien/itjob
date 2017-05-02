<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
	const ADMIN = 1;
	const COMPANY = 2;
	const MEMBER = 3;
    use Notifiable;

	protected $fillable = [
        'email', 'password', 'role'
    ];
    
    protected $table = 'accounts';

    /**
     * Get company
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }

    /**
     * Get admin
     */
    public function admin()
    {
        return $this->hasOne('App\Models\Admin');
    }

    /**
     * Get member
     */
    public function member()
    {
        return $this->hasOne('App\Models\Member');
    }
}
