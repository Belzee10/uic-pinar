<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public $table = "clubes";

    protected $fillable = [
        'nombre', 'descripcion', 'simbolo', 'nombre_simbolo'
    ];
    
    public function usuarios() {
        return $this->belongsToMany('App\User')->withPivot('lider');
    }
}
