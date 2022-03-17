<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле <:attribute> обязательно для заполнения',
            'email' => 'Email должен быть валидным',
        ];
    }

    public function attributes(){
        return [
            'password' => 'Пароль',
        ];
    }
}
