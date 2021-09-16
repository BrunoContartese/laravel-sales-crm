<?php

namespace App\Http\Requests\Accounting\Tributes;

use App\Models\Accounting\TributeAliquot;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTributeAliquotRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('tributes.create');
    }

    public function rules()
    {
        return TributeAliquot::$rules;
    }

    public function messages()
    {
        return TributeAliquot::$messages;
    }
}