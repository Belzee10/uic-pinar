<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActividad extends FormRequest
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
            'fecha' => 'required|date_format:Y-m-d',
            'estado' => 'required',
            'usuario_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo requerido.',
            'fecha.date_format' => 'Formato inválido',
        ];
    }
}
