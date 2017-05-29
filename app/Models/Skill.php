<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;
    protected $table = 'skills';
    protected $fillable = ['name'];

    /**
     * Get job relationship
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job');
    }

    /**
     * Get member relationship
     */
    public function members()
    {
        return $this->belongsToMany('App\Models\Member');
    }
}
