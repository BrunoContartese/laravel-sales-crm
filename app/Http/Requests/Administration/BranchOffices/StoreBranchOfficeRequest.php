<?php

namespace App\Http\Requests\Administration\BranchOffices;

use App\Models\Administration\BranchOffice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBranchOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('branchOffices.create');
    }

    public function rules()
    {
        return BranchOffice::$rules;
    }

    public function messages()
    {
        return BranchOffice::$messages;
    }
}
