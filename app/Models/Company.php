<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    const PATH_AVATAR = 'images/avatars/';

    protected $table = 'companies';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'account_id', 'address_id', 'phone', 'about', 'avatar'
    ];

    /**
     * Get address relationship
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * Get account relationship
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    /**
     * Get jobs relationship
     */
    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }
}
