<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Tribute extends Model
{
    const IVA = 1;
    const IMPUESTOS_NACIONALES = 2;
    const IMPUESTOS_PROVINCIALES = 3;
    const IMPUESTOS_MUNICIPALES = 4;
    const IMPUESTOS_INTERNOS = 5;
    const OTRO = 6;
    const IIBB = 7;
    const PERCEPCION_IVA = 8;
    const PERCEPCION_IIBB = 9;
    const PERCEPCIONES_IMPUESTOS_MUNICIPALES = 10;
    const OTRAS_PERCEPCIONES = 11;
    const PERCEPCION_IVA_NO_CATEGORIZADO = 12;
    
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'code',
        'name'
    ];

    public static $rules = [
        'code' => 'nullable|unique:tributes,code',
        'name' => 'required|unique:tributes,name'
    ];

    public static $messages = [
        'name.required' => 'Debe ingresar el nombre del tributo',
        'name.unique' => 'El nombre ingresado ya está siendo utilizado por otro tributo.',
        'code.unique' => 'El código ingresado ya está siendo utilizado por otro tributo.'
    ];

    public function aliquots() 
    {
        return $this->hasMany(TributeAliquot::class);
    }
}