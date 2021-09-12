<?php

namespace App\Http\Requests\Administration\Products\ProductCategories;

use App\Models\Administration\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('productCategories.create');
    }

    public function rules()
    {
        $rules =  ProductCategory::$rules;
        $rules['name'] = "required|unique:product_categories,name,{$this->route()->parameter('productCategory')}";
        return $rules;
    }

    public function messages()
    {
        return ProductCategory::$messages;
    }
}
