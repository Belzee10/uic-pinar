<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurso extends FormRequest
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
            'nombre' => 'required|unique:cursos|regex:/^[a-zA-Z0-9 ]+$/u',
            'costo_matricula' => 'required|integer|between:1,999',
            'lugar' => 'required|regex:/^[a-zA-Z0-9 ]+$/u',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'capacidad' => 'required|integer|between:1,999',
            'duracion' => 'required|integer|between:1,999',
            'usuario_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo requerido.',
            'nombre.unique'  => 'Ya existe ese curso.',
            'nombre.regex'  => 'Solo se permiten letras y números',
            'costo_matricula.integer'  => 'Solo se permiten números',
            'costo_matricula.between'  => 'El rango del costo de la matrícula es de 1 - 999',
            'lugar.regex'  => 'Solo se permiten letras y números',
            'fecha_inicio.date_format' => 'Formato inválido',
            'capacidad.integer'  => 'Solo se permiten números',
            'capacidad.between'  => 'El rango de la capacidad es de 1 - 999',
            'duracion.integer'  => 'Solo se permiten números',
            'duracion.between'  => 'El rango de la duración es de 1 - 999',
        ];
    }
}
