<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    const STARTER = 1;
    const BASIC = 2;
    const MEDIUM = 3;
    const ADVANCE = 4;
    const PREMIUM = 5;

    protected $fillable = [
        'plan_name',
        'users_allowed',
        'branch_offices_allowed',
        'boxes_per_branch_office_allowed',
        'bills_per_month_allowed',
    ];
}
