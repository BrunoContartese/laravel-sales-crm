<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'plan_id',
        'fiscal_role_id',
        'is_perception_agent',
        'name',
        'owner_name',
        'document_number',
        'gross_incomes_document_number',
        'activities_init_date',
        'afip_key_file_url',
        'afip_cert_file_url',
    ];

    public static $rules = [
        'fiscal_role_id' => 'required|exists:fiscal_roles,id',
        'is_perception_agent' => 'required',
        'name' => 'required',
        'owner_name' => 'required',
        'document_number' => 'required',
        'gross_incomes_document_number' => 'required',
        'activities_init_date' => 'required|date',
        'afip_key_file_url' => 'nullable|url',
        'afip_cert_file_url' => 'nullable|url',
    ];

    public static $messages = [
        'fiscal_role_id.required' => 'Debe seleccionar su posición fiscal.',
        'fiscal_role_id.exists' => 'La posición fiscal seleccionada no es válida.',
        'is_perception_agent.required' => 'Debe indicar si es agente de percepción.',
        'name.required' => 'Debe indicar el nombre de la empresa.',
        'owner_name.required' => 'Debe indicar el nombre del representante / dueño de la empresa.',
        'document_number.required' => 'Debe indicar el CUIT de la empresa.',
        'gross_incomes_document_number.required' => 'Debe indicar el Nº de II.BB de la empresa.',
        'activities_init_date.required' => 'Debe indicar la fecha de inicio de actividad de la empresa.',
    ];

    public function fiscalRole() 
    {
        return $this->belongsTo(FiscalRole::class);
    }

    public function plan() 
    {
        return $this->belongsTo(Plan::class);
    }
}
