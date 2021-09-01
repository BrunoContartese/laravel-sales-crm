<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{

    const CUIT = 1;
    const DNI = 2;
    const OTRO = 3;
    const CUIL = 4;
    const LE = 5;
    const LC = 6;
    
    protected $fillable = [
        'name',
        'code'
    ];
}
