<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    const ACTIVE = 1;
    const DEACTIVE = 0  ;

    protected $table = 'jobs';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'address_id', 'salary_id', 'describe', 'company_id', 'status', 'quantity', 'deadline'
    ];

    /**
     * Get company relationship
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * Get address relationship
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * Get salary relationship
     */
    public function salary()
    {
        return $this->belongsTo('App\Models\Salary');
    }

    /**
     * Get skill relationship
     */
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill')->withTimestamps();
    }

    /**
     * Get levels relationship
     */
    public function levels()
    {
        return $this->belongsToMany('App\Models\Level')->withTimestamps();
    }
}
