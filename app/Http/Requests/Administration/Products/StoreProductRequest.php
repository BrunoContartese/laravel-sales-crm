<?php

namespace App\Http\Requests\Administration\Products;

use App\Models\Administration\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('products.create');
    }

    public function rules()
    {
        return Product::$rules;
    }

    public function messages()
    {
        return Product::$messages;
    }
}