<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const ACTIVE = 1;
    const DEACTIVE = 0  ;
    const CHECKED = 1;
    const UNCHECK = 0  ;

    protected $table = 'jobs';

    protected $fillable = [
        'title', 'address_id', 'salary_id', 'quantity', 'describe', 'company_id', 'status', 'check', 'deadline'
    ];

    /**
     * Get company for job.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * Get address for job.
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * Get salary for job.
     */
    public function salary()
    {
        return $this->belongsTo('App\Models\Salary');
    }

    /**
     * Get skill for job
     */
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill')->withTimestamps();;
    }

    /**
     * Get levels for job
     */
    public function levels()
    {
        return $this->belongsToMany('App\Models\Level');
    }
}
