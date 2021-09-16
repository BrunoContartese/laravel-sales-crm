<?php

namespace App\Http\Requests\Accounting\Tributes;

use App\Models\Accounting\Tribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTributeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can('tributes.create');
    }

    public function rules()
    {
        return Tribute::$rules;
    }

    public function messages()
    {
        return Tribute::$messages;
    }
}