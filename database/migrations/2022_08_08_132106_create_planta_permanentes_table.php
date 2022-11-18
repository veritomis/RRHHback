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
        Schema::create('planta_permanentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agente_id')->constrained('agentes');
            $table->string('letra_nivel');
            $table->string('numero_grado');
            $table->string('tramo');
            $table->string('agrupamiento');
            $table->string('modalidad_vinculacion');
            $table->string('asistencia');
            $table->string('nivel_funcion_ejecutiva')->nullable();
            $table->string('nivel_funcion_ejecutiva_otro')->nullable();
            $table->string('puesto_agente');
            $table->boolean('es_ejecutivo')->default(0);
            $table->boolean('es_titular')->default(0);

            //relaciones
            //$table->integer('area_id');

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
        Schema::dropIfExists('planta_permanentes');
    }
};
