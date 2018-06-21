<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoInscripcion extends FormRequest
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
            'nombre_completo' => 'required|regex:/^[a-zA-Z ]+$/u',
            'correo' => 'required',
            'telefono' => 'required|digits:8',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo requerido.',
            'regex'  => 'Solo se permiten letras.',
            'digits' => 'El teléfono debe contener 8 dígitos.'
        ];
    }
}
