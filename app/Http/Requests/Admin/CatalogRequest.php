<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'meta_tag_title' => 'required|max:100',
            'name' => 'required|max:100',
            'position'=> 'integer',
            'per_page' => 'integer',
            'url' => 'required|max:60|alpha_dash|unique:catalogs,url',
            'description' => 'required'
        ];
        if ($this->route()->named('catalog.update')) {
            $rules['url'] .= ',' . $this->route()->parameter('catalog')->id;
        }


        return $rules;
    }

    public function messages() {
        return [
            'required' => 'Поля :attribute обязательно для заполенния',
            'unique' => 'Значение :attribute должны быть уникально',
            'max' => 'Максмиальная длина поля :attribute :max символов',
            'alpha' => 'Поле :attribute должно содержать только латинские символы без цифр и знаков тире и подчеркивания'
        ];
    }

}
