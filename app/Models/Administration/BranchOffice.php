<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class BranchOffice extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'whatsapp',
        'facebook',
        'instagram',
        'lat',
        'long'
    ];

    public static $rules = [
        'name' => 'required|unique:branch_offices,name',
        'email' => 'nullable|email'
    ];

    public static $messages = [
        'name.required' => 'Debe ingresar el nombre de la sucursal.',
        'name.unique' => 'El nombre ingresado ya pertenece a otra sucursal.',
        'email.email' => 'La dirección de email ingresada no tiene un formato válido.'
    ];
}
