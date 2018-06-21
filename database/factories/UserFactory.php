<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'nombre_completo' => 'admin',
        'sexo' => 'masculino',
        'fecha_nacimiento' => date($format = 'Y-m-d'),
        'ci' => 'sin definir',
        'direccion_particular' => 'sin definir',
        'provincia' => 'sin definir',
        'municipio' => 'sin definir',
        'telefono_personal' => 'sin definir',        
        'email' => 'admin@email.com',
        'titulo_profesional' => 'sin definir',
        'universidad' => 'sin definir',
        'ano_graduado' => 0,
        'centro_trabajo' => 'sin definir',
        'direccion_laboral' => 'sin definir',
        'provincia_laboral' => 'sin definir',
        'municipio_laboral' => 'sin definir',
        'telefono_laboral' => 'sin definir',
        'correo_laboral' => 'admin@email.com',
        'cargo_laboral' => 'sin definir',
        'presidente' => false,
        'vicepresidente' => false,
        'vocal' => false,
        'activista' => false,
        'rol' => 'admin',
        'password' => bcrypt('123'),
        'activo' => true
    ];
});
