<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_completo');
            $table->enum('sexo', ['masculino', 'femenino']);
            $table->date('fecha_nacimiento');
            $table->string('ci');
            $table->string('direccion_particular');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('telefono_personal', 180)->unique();
            $table->string('email', 180)->unique();//correo personal
            $table->string('titulo_profesional');
            $table->string('universidad');
            $table->integer('ano_graduado');
            $table->string('centro_trabajo');
            $table->string('direccion_laboral');
            $table->string('provincia_laboral');
            $table->string('municipio_laboral');
            $table->string('telefono_laboral');
            $table->string('correo_laboral');
            $table->string('cargo_laboral');
            $table->boolean('presidente')->default(false);//1
            $table->boolean('vicepresidente')->default(false);//1
            $table->boolean('vocal')->default(false);//1
            $table->boolean('activista')->default(false);//4
            $table->enum('rol', ['admin', 'directivo', 'miembro']);
            $table->string('password');
            $table->boolean('activo');
            $table->string('confirmation_code')->nullable();

            $table->integer('organismo_id')->unsigned()->nullable(true);
            $table->foreign('organismo_id')
                  ->references('id')->on('organismos')
                  ->onDelete('cascade');
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
