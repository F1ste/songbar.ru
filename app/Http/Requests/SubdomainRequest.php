<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubdomainRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'address' => 'required|string|max:255|regex:/^[a-zA-Z0-9\-]+$/|unique:catalogs,address',
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'Введите поддомен.',
            'address.regex' => 'Поддомен может содержать только буквы, цифры и дефисы.',
            'address.unique' => 'Такой поддомен уже существует.',
        ];
    }
}
