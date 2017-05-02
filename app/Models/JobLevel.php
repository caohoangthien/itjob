<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLevel extends Model
{
    protected $table = 'joblevels';

    protected $fillable = [
        'job_id', 'level_id'
    ];
}
