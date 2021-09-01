<?php

namespace App\Http\Requests\Administration\BranchOffices;

use App\Models\Administration\BranchOffice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBranchOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('branchOffices.edit');
    }

    public function rules()
    {
        $rules =  BranchOffice::$rules;
        $rules['name'] = "required|unique:branch_offices,name,{$this->route()->parameter('branchOffice')}";
        return $rules;
    }

    public function messages()
    {
        return BranchOffice::$messages;
    }
}
