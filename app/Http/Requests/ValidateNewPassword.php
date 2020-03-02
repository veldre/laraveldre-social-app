<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNewPassword extends FormRequest
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
            'current-password' => 'required',
            'new-password' => 'required|min:8|string',
            'confirm-new-password' => 'required|min:8|string|same:new-password'
        ];
    }
}
