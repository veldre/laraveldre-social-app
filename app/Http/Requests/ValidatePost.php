<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePost extends FormRequest
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
            'post-title' => 'required|min:10|max:100',
            'post-text' => 'required|min:10'
        ];
    }
}
