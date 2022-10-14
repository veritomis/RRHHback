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
        Schema::create('pp_evaluaciones_de_desempenios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planta_permanentes_id')->constrained('planta_permanentes');
            $table->date('fecha desde');
            $table->date('fecha hasta');
            $table->string('nivel de formulario');
            $table->integer('puntaje');
            $table->integer('calificacion');
            $table->boolean('fue utilizada');
            $table->boolean('tiene bonificacion');

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
        Schema::dropIfExists('pp_evaluaciones_de_desempenios');
    }
};
