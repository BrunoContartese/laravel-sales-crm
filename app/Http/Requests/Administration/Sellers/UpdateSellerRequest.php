<?php

namespace App\Http\Requests\Administration\Sellers;

use App\Models\Administration\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSellerRequest extends FormRequest
{
    
    public function authorize()
    {
        return Auth::user()->can('sellers.edit');
    }

    public function rules()
    {
        $seller = Seller::$rules;
        $seller["document"] = "unique:sellers,document,{$this->route()->parameter('seller')}";
        return $seller;
    }

    public function messages()
    {
        return Seller::$messages;
    }

}
