<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    protected $fillable = ['name'];

    /**
     * Get job relationship
     */
    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job');
    }
}
