<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    const PATH_AVATAR = 'images/avatars/';
    const PATH_CV = 'files/cv/';

    protected $table = 'members';
    protected $fillable = [
        'name', 'account_id', 'phone', 'address_id', 'gender', 'birthday', 'about', 'cv', 'avatar'
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
     * Get skills relationship
     */
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill')->withTimestamps();
    }
}
