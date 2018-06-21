<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoAsign extends FormRequest
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
            'tipo' => 'required',
            'usuario_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'Campo requerido.',
            'usuario_id.required' => 'Campo requerido.',
        ];
    }
}
