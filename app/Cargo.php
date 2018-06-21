<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $table = "cargos";

    protected $fillable = [
        'tipo', 'delegacionbase_id', 'usuario_id'
    ];

    public function usuario() {
        return $this->belongsTo('App\User');
    }

    public function delegacionbase() {
        return $this->belongsTo('App\DelegacionBase');
    }
}
