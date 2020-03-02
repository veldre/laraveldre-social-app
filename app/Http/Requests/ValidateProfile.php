<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProfile extends FormRequest
{

    public function authorize()
    {
        if (auth()->check()) {
            return true;
        }
        return false;
    }


    public function rules()
    {
        return [
            'phone' => 'nullable|min:8|max:20',
            'address' => 'nullable|min:10|max:100',
            'about' => 'nullable|min:10|max:500',
            'birthday' => 'nullable|date',
        ];

    }
}
