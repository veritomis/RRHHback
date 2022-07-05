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
            $table->id('id'); //solo id?
            $table->id('agente_id'); //este no coincide con el id de la tabla agente
                                     //va a andar igual?
            $table->date('fecha');
            $table->date('fecha_inicial');
            $table->date('fecha_fin');
            $table->string('numero_gedo'); //preguntar a juan que es y si es string
            $table->date('antiguedad_puesto'); //esto es una fecha? un numero?
            $table->date('antiguedad_total');
            //nivel
            //grado (creo que estan repetidos de la tabla agente!)
            $table->string('compensacion_transitoria'); // ver que es...
            $table->id('id_profesiones');
            $table->id('id_titulos');
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
