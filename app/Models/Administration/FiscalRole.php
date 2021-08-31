<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalRole extends Model
{
    const RESPONSABLE_INSCRIPTO = 1;
    const RESPONSABLE_MONOTRIBUTO = 2;
    const IVA_EXENTO = 3;
    const CONSUMIDOR_FINAL = 4;


    protected $fillable = [
        'name'
    ];
}
