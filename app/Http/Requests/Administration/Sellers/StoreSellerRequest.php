<?php

namespace App\Http\Requests\Administration\Sellers;

use App\Models\Administration\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSellerRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('sellers.create');
    }

    public function rules()
    {
        return Seller::$rules;
    }

    public function messages()
    {
        return Seller::$messages;
    }

}
