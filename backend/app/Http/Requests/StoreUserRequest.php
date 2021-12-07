<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dni'       => 'required|integer|digits_between:7, 8',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
