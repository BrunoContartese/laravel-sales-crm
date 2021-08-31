<?php

namespace App\Http\Requests\Administration\Companies;

use App\Models\Administration\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('companies.edit');
    }

    public function rules()
    {
        return Company::$rules;
    }

    public function messages()
    {
        return Company::$messages;
    }
}
