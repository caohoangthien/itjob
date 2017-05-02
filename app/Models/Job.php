<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    protected $fillable = [
        'title', 'address_id', 'salary_id', 'quantity', 'describe', 'company_id'
    ];
}
