<?php

namespace App\Models\Administration;

use App\Models\Accounting\AccountingRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Supplier extends Model
{
    use Userstamps, SoftDeletes;

    protected $fillable = [
        'given_name',
        'family_name',
        'address',
        'fiscal_role_id',
        'document_type_id',
        'document_number',
        'email',
        'phone_number',
        'comments',
        'accounting_record_id'
    ];

    public static $rules = [
        'given_name' => 'required',
        'family_name' => 'required',
        'email' => 'nullable|email',
        'fiscal_role_id' => 'required|exists:fiscal_roles,id',
        'document_type_id' => 'required|exists:document_types,id',
        'document_number' => 'required|unique:suppliers,document_number',
        'accounting_record_id' => 'nullable|exists:accounting_records,id'
    ];

    public static $messages = [
        'given_name.required' => 'Debe ingresar el nombre del proveedor.',
        'family_name.required' => 'Debe ingresar el apellido del proveedor.',
        'email.email' => 'El email ingresado no tiene un formato válido.',
        'fiscal_role_id.required' => 'Debe ingresar la condición fiscal del proveedor.',
        'fiscal_role_id.exists' => 'La condición fiscal seleccionada no es válida.',
        'document_type_id.required' => 'Debe ingresar el tipo de documento del proveedor.',
        'document_type_id.exists' => 'El tipo de documento seleccionado no es válido',
        'document_number.required' => 'Debe ingresar el número de documento del proveedor.',
        'document_number.unique' => 'El número de documento ingresado ya pertenece a un proveedor cargado en el sistema.',
        'accounting_record_id.exists' => 'La cuenta contable seleccionada no es válida.'
    ];

    public function fiscalRole() 
    {
        return $this->belongsTo(FiscalRole::class);
    }

    public function documentType() 
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function accountingRecord() 
    {
        return $this->belongsTo(AccountingRecord::class);
    }
}
