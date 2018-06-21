<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    public $table = "ips";

    protected $fillable = [
        'nombre'
    ];

    public function usuarios() {
        return $this->belongsToMany('App\User');
    }

}
