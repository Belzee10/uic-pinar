<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fichero extends Model
{
    public $table = "ficheros";

    protected $fillable = [
        'nombre', 'tipo', 'extension', 'fichero'
    ];
}
