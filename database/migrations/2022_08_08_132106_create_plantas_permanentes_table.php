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
        Schema::create('plantas_permanentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agente_id')->constrained('agentes');
            
            // esto ya esta en la tabla agente, lo de nivel y grado, va de nuevo?
            $table->string('letra_nivel');
            $table->string('numero_grado');
            
             
            $table->string('tramo');
            $table->string('agrupamiento');

            $table->string('modalidad_vinculacion');
            $table->string('estado_agente');
            $table->string('funcion');
            $table->date('ejercicio');
            $table->string('numero_expediente');
            $table->string('estado_expediente');
            $table->string('numero_formulario');
            $table->string('nivel_formulario');
            $table->string('calificacion');
            $table->integer('puntaje');
            $table->string('evaluador');

            //relaciones
            $table->integer('area_id');

            $table->string('unidad_analisis');
            $table->boolean('notificacion');
            $table->string('numero_notificacion')->nullable();
            $table->string('observacion');
            $table->boolean('corrimiento_grado'); 
            $table->string('numero_expediente_grado');
            $table->boolean('corrimiento_agrupamiento');
            $table->string('numero_expediente_agrupacion');
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
        Schema::dropIfExists('plantaspermanentes');
    }
};
