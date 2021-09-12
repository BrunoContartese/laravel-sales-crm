<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class AccountingRecordType extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'name'
    ];
}
