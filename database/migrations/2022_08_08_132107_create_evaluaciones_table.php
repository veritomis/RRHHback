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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planta_permanentes_id')->constrained('planta_permanentes');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('nivel_formulario');
            $table->integer('puntaje');
            $table->integer('calificacion');
            $table->boolean('fue_utilizada');
            $table->boolean('tiene_bonificacion');

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
        Schema::dropIfExists('evaluaciones');
    }
};
