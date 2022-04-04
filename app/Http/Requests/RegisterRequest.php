<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' =>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле "Имя" является обязательным',
            'email.required' => 'Поле "Почта" является обязательным',
            'password.required' => 'Поле "Пароль" является обязательным',
            'email.unique' => 'Данная почта уже занята',
        ];
    }
}
