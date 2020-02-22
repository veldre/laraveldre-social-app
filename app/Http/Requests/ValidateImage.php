<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateImage extends FormRequest
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
            'image' => 'file|image|max:5000'
        ];
    }
}
