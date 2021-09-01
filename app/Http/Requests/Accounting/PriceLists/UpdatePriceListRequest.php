<?php

namespace App\Http\Requests\Accounting\PriceLists;

use App\Models\Accounting\PriceList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePriceListRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('priceLists.edit');
    }

    public function rules()
    {
        $rules = PriceList::$rules;
        $rules['name'] = "required|unique:price_lists,name,{$this->route()->parameter('priceList')}";
        return $rules;
    }

    public function messages()
    {
        return PriceList::$messages;
    }
}
