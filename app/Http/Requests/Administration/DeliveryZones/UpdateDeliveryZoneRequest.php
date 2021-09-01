<?php

namespace App\Http\Requests\Administration\DeliveryZones;

use App\Models\Administration\DeliveryZone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDeliveryZoneRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('deliveryZones.edit');
    }

    public function rules()
    {
        $rules = DeliveryZone::$rules;
        $rules['name'] = "required|unique:delivery_zones,name,{$this->route()->parameter('deliveryZone')}";
        return $rules;
    }

    public function messages()
    {
        return DeliveryZone::$messages;
    }
}
