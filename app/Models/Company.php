<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name', 'account_id', 'address_id', 'phone', 'about', 'avatar'
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }
}
