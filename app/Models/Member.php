<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'name', 'account_id', 'phone', 'address_id', 'gender', 'birthday', 'about', 'cv', 'avatar'
    ];

    /**
     * Get address
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill');
    }
}
