<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelegacionBase extends Model
{
    public $table = "delegacionesbase";

    protected $fillable = [
        'nombre'
    ];

    public function organismos() {
        return $this->hasMany('App\Organismo');
    }

    public function cargos() {
        return $this->hasMany('App\Cargo');
    }
}
