<?php

namespace App\Http\Requests\Administration\Suppliers;

use App\Models\Administration\Supplier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('suppliers.create');
    }

    public function rules()
    {
        return Supplier::$rules;
    }

    public function messages()
    {
        return Supplier::$messages;
    }
}
