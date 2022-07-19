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
            //$table->date('antiguedad_puesto'); //esto es una fecha? un numero?
            $table->date('antiguedad_total');
            $table->string('letra_nivel')->nullable();
            $table->string('numero_grado')->nullable();
            
            $table->string('compensacion_transitoria'); // ver que es...
            $table->foreignId('profesion_id')->constrained('profesiones');
            $table->foreignId('titulo_id')->constrained('titulos');

            //$table->unsignedBigInteger('id_profesiones');
            // $table->unsignedBigInteger('id_titulos');
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
