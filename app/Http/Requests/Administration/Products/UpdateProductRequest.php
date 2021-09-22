<?php

namespace App\Http\Requests\Administration\Products;

use App\Models\Administration\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('products.edit');
    }

    public function rules()
    {
        $rules = Product::$rules;
        $rules['barcode'] = "required|unique:products,barcode,{$this->route()->parameter('product')}";
        return $rules;
    }

    public function messages()
    {
        return Product::$messages;
    }
}