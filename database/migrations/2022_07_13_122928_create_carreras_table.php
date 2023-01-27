<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('agente_id')->constrained('agentes');
            $table->date('fecha');
            $table->date('fecha_inicial');
            $table->date('fecha_fin');
            $table->string('numero_gedo'); //preguntar a juan que es y si es string
            //$table->date('antiguedad_puesto'); //esto es una fecha? un numero?
            $table->date('antiguedad_administracion_publica');
            $table->string('letra_nivel')->nullable();
            $table->string('numero_grado')->nullable();

            $table->string('compensacion_transitoria'); // ver que es...
            $table->enum('nivel_educativo',['Primario incompleto','Primario completo','Secundario incompleto','Secundario completo','Terciario incompleto','Terciario completo','Universitario incompleto','Universitario completo','Otro'])->default('Primario completo');
            $table->string('nivel_educativo_otro')->index()->nullable();
            $table->foreignId('profesion_id')->constrained('profesiones');
            $table->foreignId('titulo_id')->constrained('titulos');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
};
