<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Seller extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'given_name',
        'family_name',
        'address',
        'document',
        'email',
        'phone_number',
        'celphone_number',
        'document_type_id',
        'delivery_zone_id'
    ];

    public static $rules = [
        'given_name' => 'required',
        'family_name' => 'required',
        'document' => 'nullable|unique:sellers,document',
        'email' => 'nullable|email',
        'document_type_id' => 'nullable|exists:document_types,id',
        'delivery_zone_id' => 'nullable|exists:delivery_zones,id',
    ];

    public static $messages = [
        'given_name.required' => 'El campo Nombre no puede estar vacío.',
        'family_name.required' => 'El campo Apellido no puede estar vacío.',
        'email.email' => 'El email ingresado no tiene un formato válido.',
        'document.unique' => 'El N° de Documento ingresado ya existe en la base de datos.',
        'document_type_id.exists' => 'El tipo de documento seleccionado no es válido.',
        'delivery_zone_id.exists' => 'La zona de entrega seleccionada no es válida'
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function deliveryZone()
    {
        return $this->belongsTo(DeliveryZone::class);
    }
}
