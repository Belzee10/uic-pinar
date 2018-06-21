<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'nombre_completo' => 'required|regex:/^[a-zA-Z ]+$/u',
            'provincia_municipio' => 'required',
            'telefono_personal' => 'required|digits:8|unique:users',
            'sexo' => 'required',
            'ci' => 'required|unique:users',
            'direccion_particular' => 'required',
            'email' => 'required|unique:users',
            'titulo_profesional' => 'required|regex:/^[a-zA-Z ]+$/u',
            'ano_graduado' => 'required',
            'universidad' => 'required|regex:/^[a-zA-Z ]+$/u',
            'centro_trabajo' => 'required|regex:/^[a-zA-Z ]+$/u',
            'provincia_municipio_laboral' => 'required',
            'correo_laboral' => 'required|unique:users',
            'organismo_id' => 'required',
            'direccion_laboral' => 'required',
            'telefono_laboral' => 'required|digits:8',
            'cargo_laboral' => 'required|regex:/^[a-zA-Z ]+$/u',
            'rol' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo requerido.',
            'email.unique'  => 'Ya existe esa dirección de correo.',
            'correo_laboral.unique'  => 'Ya existe esa dirección de correo.',
            'telefono_personal.unique' => 'Ya existe ese teléfono.',
            'ci.unique'  => 'Ya existe ese carnet de identidad.',
            'regex'  => 'Solo se permiten letras.',
            'integer'  => 'Solo se permiten números.',
            'email' => 'Debe ser una dirección de correo válida.',
            'digits' => 'El teléfono debe contener 8 dígitos.'
        ];
    }
}
