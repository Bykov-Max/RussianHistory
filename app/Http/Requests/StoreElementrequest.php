<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreElementrequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:155',
            'description' => ['nullable'],
            'back_image' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле <:attribute> обязательно для заполнения',
            'min' => 'В поле <:attribute> должно быть не менее :min символов.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название элемента',
            'description' => 'Текст элемента'
        ];
    }
}
