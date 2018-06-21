<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    public $table = "actividades";

    protected $fillable = [
        'tipo', 'fecha', 'estado', 'usuario_id'
    ];

    protected $dates = [
        'fecha'
    ];

    public function usuario() {
        return $this->belongsTo('App\User');
    }   
}
