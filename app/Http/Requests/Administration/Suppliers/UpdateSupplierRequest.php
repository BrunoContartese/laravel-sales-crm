<?php

namespace App\Http\Requests\Administration\Suppliers;

use App\Models\Administration\Supplier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('suppliers.edit');
    }

    public function rules()
    {
        $rules = Supplier::$rules;
        $rules['document_number'] = "required|unique:suppliers,document_number,{$this->route()->parameter('supplier')}";
        return $rules;
    }

    public function messages()
    {
        return Supplier::$messages;
    }
}
