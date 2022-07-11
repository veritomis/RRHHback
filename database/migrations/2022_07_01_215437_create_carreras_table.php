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
            $table->unsignedBigInteger('id_agente'); 
            $table->date('fecha');
            $table->date('fecha_inicial');
            $table->date('fecha_fin');
            $table->string('numero_gedo'); //preguntar a juan que es y si es string
            $table->date('antiguedad_puesto'); //esto es una fecha? un numero?
            $table->date('antiguedad_total');
            //nivel
            //grado (creo que estan repetidos de la tabla agente!)
            $table->string('compensacion_transitoria'); // ver que es...
            $table->unsignedBigInteger('id_profesiones');
            $table->unsignedBigInteger('id_titulos');
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
