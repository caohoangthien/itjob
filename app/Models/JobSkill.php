<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    protected $table = 'job_skill';

    protected $fillable = [
        'job_id', 'skill_id'
    ];
}
