<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormOrderSparePartRequest extends FormRequest
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
            'phone' => 'required|phone:US,RU,BE',
            'spart' => 'required',
            'email' => 'required|email',
            'name' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'phone' => 'Неправильный формат номера телефона',
            'phone.required' => 'Поле телефон обязательно для заполнения.',
            'email' => 'Поле должно содежать правильный формат E-mail адреса',
            'email.required' => 'Поле E-mail обязательно для заполнения.',
            'spart.required' => 'Поле запчасть обязательно для заполнения.',
            'address.required' => 'Поле адрес бурения обязательно для заполнения.',
            'name.required' => 'Поле имя обязательно для заполнения.',
            'review.required' => 'Поле отзыв обязательно для заполнения.',
            'phone.regex' => 'Неправильный формат номера телефона'
        ];
    }
}
