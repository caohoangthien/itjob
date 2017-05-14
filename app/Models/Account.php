<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

	const ADMIN = 1;
	const COMPANY = 2;
	const MEMBER = 3;

	protected $fillable = [
        'email', 'password', 'role'
    ];
    protected $table = 'accounts';

    /**
     * Get company relationship
     */
    public function company()
    {
        return $this->hasOne('App\Models\Company');
    }

    /**
     * Get admin relationship
     */
    public function admin()
    {
        return $this->hasOne('App\Models\Admin');
    }

    /**
     * Get member relationship
     */
    public function member()
    {
        return $this->hasOne('App\Models\Member');
    }
}
