<?php

namespace App\Http\Requests\Administration\Products\ProductCategories;

use App\Models\Administration\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('productCategories.create');
    }

    public function rules()
    {
        return ProductCategory::$rules;
    }

    public function messages()
    {
        return ProductCategory::$messages;
    }
}
