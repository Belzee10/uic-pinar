<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Ci implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validarCI($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Carnet de identidad inválido.';
    }

    private function validarCI($ci){

        // primero me aseguro que la longitud del ci sea de 11 y no mas ni menos
        $ci = str_split($ci); // convierto el ci en un arreglo

        if(count($ci) !== 11){ return false;} // verifico que sea exactamente de 11 digitos

        // verifico que el mes no sea mayor que 12. Tener encuenta que el mes se almacena en la posicion 3 y 4
        $mes = (int)($ci[2].$ci[3]);

        if($mes == 0 || $mes > 12) { return false; } // verifico que la suma no sea cero ni mayor que 12

        // dependiendo del mes hay que verificar el dia permitido
        $dia = (int)($ci[4].$ci[5]);

        if($dia == 0) { return false; }

        // evitar que se sobrepasen los dias permitidos para un mes dado
        switch ($mes){
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                if($dia > 31){ return false; }
                break;
            case "2":
                if($dia > 28) { return false; }
                break;
            case "4":
            case "6":
            case "9":
            case "11":
                if($dia > 30) { return false; }
                break;
        }

        return true;
    }
}
