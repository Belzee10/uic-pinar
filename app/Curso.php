<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $table = "cursos";

    protected $fillable = [
        'nombre', 'costo_matricula', 'lugar', 'fecha_inicio', 'capacidad', 'duracion', 'descripcion', 'usuario_id'
    ];

    protected $dates = [
        'fecha_inicio'
    ];

    public function usuario() {
        return $this->belongsTo('App\User');
    }

    public function participantes() {
        return $this->hasMany('App\Participante');
    }
}
