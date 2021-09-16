<?php

namespace App\Http\Requests\Accounting\Tributes;

use App\Models\Accounting\Tribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTributeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('tributes.edit');
    }

    public function rules()
    {
        $rules = Tribute::$rules;
        $rules['name'] = "required|unique:tributes,name,{$this->route()->parameters('tribute')}";
        $rules['code'] = "required|unique:tributes,code,{$this->route()->parameters('tribute')}";
        return $rules;
    }

    public function messages()
    {
        return Tribute::$messages;
    }
}