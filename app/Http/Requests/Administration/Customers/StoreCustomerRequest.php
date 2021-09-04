<?php

namespace App\Http\Requests\Administration\Customers;

use App\Models\Administration\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCustomerRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('customers.create');
    }

    public function rules()
    {
        return Customer::$rules;
    }

    public function messages()
    {
        return Customer::$messages;
    }

}
