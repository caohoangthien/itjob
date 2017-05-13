<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

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
