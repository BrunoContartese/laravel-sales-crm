<?php

namespace App\Http\Requests\Administration\Customers;

use App\Models\Administration\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('customers.edit');
    }

    public function rules()
    {
        $rules = Customer::$rules;
        $rules['document'] = "required|unique:customers,document,{$this->route()->parameter('customer')}";
        return $rules;
    }

    public function messages()
    {
        return Customer::$messages;
    }
}
