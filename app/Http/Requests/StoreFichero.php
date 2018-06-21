<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFichero extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->rol == 'admin' ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fichero' => 'required|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo requerido.',
            'fichero.max' => 'Solo ficheros hasta 5Mb'
        ];
    }
}
