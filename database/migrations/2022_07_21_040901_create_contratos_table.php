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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_alta', ['Pura', 'Renovacion','Adenda','Cambio de Nivel','Movilidad Interna'])->default('Pura');
            $table->boolean('caracter_contrato')->default(0);
            $table->string('tipo_servicio');
            $table->string('objetivo_general');
            $table->string('objetivo_especifico');
            $table->string('actividades_tarea');
            $table->string('resultado_parcial_final');
            $table->string('estandares_cualitativos_cuantitativos');
            $table->date('fecha_obtencion_resultados');
            $table->string('horario_propuesto');
            $table->string('nivel_educativo');
            $table->string('numero_nota_expediente_electronico');
            $table->string('numero_resolucion');
            $table->boolean('estado');

            //relaciones
            // $table->integer('vinculacion_laboral_id');
            // $table->integer('asistenacia_tipo_contratacion_id');

            $table->integer('agente_id');
            $table->integer('area_id');
            $table->integer('titulo_orientacion_id');
            $table->integer('puesto_trabajo_id');
            $table->integer('familia_id');
            $table->integer('sub_familia_id');
            $table->integer('puesto_nomenclatura_id');
            $table->integer('funcion_trabajo_id');

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
        Schema::dropIfExists('contratos');
    }
};
