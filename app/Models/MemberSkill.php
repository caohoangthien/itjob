<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberSkill extends Model
{
    protected $table = 'memberskills';

    protected $fillable = [
        'member_id', 'skill_id'
    ];
}
