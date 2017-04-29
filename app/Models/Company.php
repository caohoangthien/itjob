<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }
}
