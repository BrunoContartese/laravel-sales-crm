<?php

namespace App\Http\Requests\Administration\DeliveryZones;

use App\Models\Administration\DeliveryZone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDeliveryZoneRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('deliveryZones.create');
    }

    public function rules()
    {
        return DeliveryZone::$rules;
    }

    public function messages()
    {
        return DeliveryZone::$messages;
    }
}
