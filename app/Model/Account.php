<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
	const ADMIN = 1;
	const COMPANY = 2;
	const MEMBER = 3;
    use Notifiable;

	protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $table = 'accounts';

    /**
     * Get company
     */
    public function company()
    {
        return $this->hasOne('App\Model\Company');
    }

    /**
     * Get admin
     */
    public function admin()
    {
        return $this->hasOne('App\Model\Admin');
    }

    /**
     * Get member
     */
    public function member()
    {
        return $this->hasOne('App\Model\Member');
    }
}
