<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    public $table = "cotizaciones";

    protected $fillable = [
        'importe', 'mes', 'ano', 'usuario_id'
    ];

    public function usuario() {
        return $this->belongsTo('App\User');
    }
}
