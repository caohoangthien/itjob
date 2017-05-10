<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    /**
     * Get job for skill
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job');
    }
}
