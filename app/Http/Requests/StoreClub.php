<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClub extends FormRequest
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
            'nombre' => 'required|unique:clubes|regex:/^[a-zA-Z ]+$/u',
            'simbolo' => 'image',
            'descripcion' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Campo requerido.',
            'nombre.unique'  => 'Ya existe ese club.',
            'nombre.regex'  => 'Solo se permiten letras.',
            'simbolo.image'  => 'El símbolo debe ser una imagen (jpeg, png, bmp, gif, or svg)',
            'descripcion.required' => 'Campo requerido.',
        ];
    }
}
