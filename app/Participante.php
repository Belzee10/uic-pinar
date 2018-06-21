<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    public $table = "participantes";

    protected $fillable = [
        'nombre_completo', 'ci', 'correo', 'telefono', 'curso_id'
    ];

    public function curso() {
        return $this->belongsTo('App\Curso');
    }
}
