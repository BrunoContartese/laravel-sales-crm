<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class SaleConcept extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [

    ];

    public static $rules = [

    ];

    public static $messages = [

    ];
}