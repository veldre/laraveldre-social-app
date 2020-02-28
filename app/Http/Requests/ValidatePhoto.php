<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePhoto extends FormRequest
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
            'photo' => 'required|file|image|max:5000',
            'photo-title' => 'required|min:2|max:20',
            'photo-description' =>'required|max:100'
        ];
    }
}
