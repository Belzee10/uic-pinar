<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganismo extends FormRequest
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
            'nombre' => 'required|unique:organismos|regex:/^[a-zA-Z ]+$/u'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Campo requerido.',
            'nombre.unique'  => 'Ya existe ese organismo.',
            'nombre.regex'  => 'Solo se permiten letras',
        ];
    }
}
