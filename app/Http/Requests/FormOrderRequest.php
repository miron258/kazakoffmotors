<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FormOrderRequest extends FormRequest
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
    public function rules(Request $request)
    {

        ///Поля для обязательной валидации
        $rules = [
            'phone' => 'required|phone:US,RU,BE',
            'email' => 'required|email',
            'name' => 'required|min:3',
            'surname' => 'required|min:3'
        ];
        ///Добавляем дополнительные поля если способ доставки не самовывоз
        if ($request->input('methodDelivery') != 1) {
            $rules = Arr::collapse([$rules, [
                'city' => 'required|min:3',
                'zipCode' => 'required|min:3',
                'houseNum' => 'required|min:1',
                'street' => 'required|min:1'
            ]]);

        }



        return $rules;
    }

    public function messages()
    {
        return [
            'phone' => 'Неправильный формат номера телефона',
            'phone.required' => 'Поле телефон обязательно для заполнения.',
            'email' => 'Поле должно содежать правильный формат E-mail адреса',
            'email.required' => 'Поле E-mail обязательно для заполнения.',
            'address.required' => 'Поле адрес бурения обязательно для заполнения.',
            'name.required' => 'Поле имя обязательно для заполнения.',
            'city.required' => 'Поле город обязательно для заполнения.',
            'houseNum.required' => 'Поле номер дома обязательно для заполнения.',
            'street.required' => 'Поле улица обязательно для заполнения.',
            'phone.regex' => 'Неправильный формат номера телефона'
        ];
    }
}
