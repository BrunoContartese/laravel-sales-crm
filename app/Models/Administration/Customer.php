<?php

namespace App\Models\Administration;

use App\Models\Accounting\PriceList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Customer extends Model
{
    use SoftDeletes, Userstamps;

    protected $fillable = [
        'given_name',
        'family_name',
        'address',
        'document_type_id',
        'document',
        'email',
        'phone_number',
        'cellphone_number',
        'fiscal_role_id',
        'price_list_id',
        'delivery_zone_id',
        'seller_id',
        'enable_current_account',
    ];

    public static $rules = [
        'given_name' => 'required',
        'family_name' => 'required',
        'document_type_id' => 'required|exists:document_types,id',
        'document' => 'required|unique:customers,document',
        'email' => 'nullable|email',
        'fiscal_role_id' => 'required|exists:fiscal_roles,id',
        'price_list_id' => 'required|exists:price_lists,id',
        'delivery_zone_id' => 'nullable|exists:delivery_zones,id',
        'seller_id' => 'required|exists:sellers,id',
    ];

    public static $messages = [
        'given_name.required' => 'required',
        'family_name.required' => 'required',
        'document_type_id.required' => 'Debe seleccionar el tipo de documento.',
        'document_type_id.exists' => 'El tipo de documento seleccionado no es válido.',
        'document.required' => 'Debe ingresar el nº de documento del cliente',
        'document.unique' => 'El nº de documento ingresado ya está registrado en la base de datos.',
        'email.email' => 'El email no tiene un formato válido.',
        'fiscal_role_id.required' => 'Debe seleccionar la condición fiscal del cliente.',
        'fiscal_role_id.exists' => 'La condición fiscal seleccionada no es válida.',
        'price_list_id.required' => 'Debe seleccionar una lista de precios por defecto.',
        'price_list_id.exists' => 'La lista de precios seleccionada no es válida.',
        'delivery_zone_id.exists' => 'La zona de entrega seleccionada no es válida.',
        'seller_id.required' => 'Debe asignar un vendedor.',
        'seller_id.exists' => 'El vendedor seleccionado no es válido.',
    ];

    public function documentType() 
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function fiscalRole() 
    {
        return $this->belongsTo(FiscalRole::class);
    }

    public function priceList() 
    {
        return $this->belongsTo(PriceList::class)->withTrashed();
    }

    public function deliveryZone() 
    {
        return $this->belongsTo(DeliveryZone::class)->withTrashed();
    }

    public function seller() 
    {
        return $this->belongsTo(Seller::class)->withTrashed();
    }

}
