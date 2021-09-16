<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class TributeAliquot extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'tribute_id',
        'code',
        'aliquot'
    ];

    public static $rules = [
        'tribute_id' => 'required|exists:tributes,id',
        'aliquot' => 'number|min:0'
    ];

    public static $messages = [
        'tribute_id.required' => 'Debe seleccionar el tributo.',
        'tribute_id.exists' => 'El tributo seleccionado no es válido.',
        'aliquot.number' => 'La alícuota debe ser un número positivo.',
        'aliquot.min' => 'La alícuota debe ser un número positivo.'
    ];
}