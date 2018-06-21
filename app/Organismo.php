<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    public $table = "organismos";

    protected $fillable = [
        'nombre', 'delegacionbase_id'
    ];

    public function delegacionbase() {
        return $this->belongsTo('App\DelegacionBase');
    }

    public function usuarios() {
        return $this->hasMany('App\User');
    }
}
