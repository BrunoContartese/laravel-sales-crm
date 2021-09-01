<?php

namespace App\Http\Requests\Administration\BranchOffices;

use App\Models\Administration\BranchOffice;
use App\Models\Administration\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StoreBranchOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('branchOffices.create');
    }

    public function rules()
    {
        $this->planCheck();
        return BranchOffice::$rules;
    }

    public function messages()
    {
        return BranchOffice::$messages;
    }

    private function planCheck()
    {
        $company = Company::find(1);
        if(BranchOffice::count() < $company->plan->branch_offices_allowed) {
            return;
        }
        
        throw ValidationException::withMessages([
            'plan_max_branch_offices' => 'Su plan no permite la creación de más sucursales.'
        ]);
    }
}
