<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAlbum extends FormRequest
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
            'cover-image' => 'required|file|image|max:5000',
            'album-name' => 'required|min:2|max:20',
            'album-description' =>'required|max:100'
        ];
    }
}
