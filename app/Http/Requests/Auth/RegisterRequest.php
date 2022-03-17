<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'password' => 'Пароль'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле <:attribute> обязательно для заполнения',
            'email' => 'Поле email должно быть валидным',
            'min' => 'В поле <:attribute> должно быть не менее :min символов.',
            'confirmed' => 'Пароли не совпадают'
        ];
    }
}
