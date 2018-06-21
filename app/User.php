<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_completo', 
        'sexo', 
        'fecha_nacimiento', 
        'ci', 
        'direccion_particular', 
        'provincia', 
        'municipio',
        'telefono_personal',
        'email', 
        'titulo_profesional', 
        'universidad', 
        'ano_graduado', 
        'centro_trabajo', 
        'direccion_laboral', 
        'provincia_laboral', 
        'municipio_laboral', 
        'telefono_laboral',
        'correo_laboral',
        'cargo_laboral',
        'presidente',
        'vicepresidente',
        'vocal',
        'activista',
        'rol',
        'password',
        'activo',
        'organismo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'fecha_nacimiento'
    ];

    public function organismo() {
        return $this->belongsTo('App\Organismo');
    }

    public function cargo() {
        return $this->hasOne('App\Cargo');
    }

    public function cotizaciones() {
        return $this->hasMany('App\Cotizacion');
    }

    public function clubes() {
        return $this->belongsToMany('App\Club')->withPivot('lider');
    }

    public function ips() {
        return $this->belongsToMany('App\Ip');
    }

    public function cursos() {
        return $this->hasMany('App\Curso');
    }

    public function actividades() {
        return $this->hasMany('App\Actividad');
    }
}
