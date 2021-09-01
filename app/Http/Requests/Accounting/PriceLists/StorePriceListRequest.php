<?php

namespace App\Http\Requests\Accounting\PriceLists;

use App\Models\Accounting\PriceList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePriceListRequest extends FormRequest
{
    
    public function authorize()
    {
        return Auth::user()->can('priceLists.create');
    }

    public function rules()
    {
        return PriceList::$rules;
    }

    public function messages()
    {
        return PriceList::$messages;
    }

}
