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
            $table->enum('caracter_contrato', ['Estacional', 'Transitorio']);
            $table->enum('nivel_categoria', ['A','B','C','D','E','F']);
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
            $table->string('numero_resolucion')->nullable();
            $table->boolean('estado')->nullable();

            $table->text('experiencia_laboral')->nullable();
            $table->text('observacion')->nullable();
            $table->text('otro_requisito')->nullable();
            $table->text('reportar')->nullable();

            //relaciones
            // $table->integer('vinculacion_laboral_id');
            // $table->integer('asistenacia_tipo_contratacion_id');
            // $table->foreignId('vinculacion_laboral_id')->constrained('vinculaciones_laborales');
            $table->foreignId('asistencia_tipo_contratacion_id')->constrained('asistencia_tipo_contrataciones');

            $table->integer('agente_id');
            $table->integer('area_id');
            $table->integer('titulo_orientacion_id');

            $table->foreignId('puesto_grupo_id')->constrained('puestos_grupos');
            $table->foreignId('puesto_familia_id')->nullable()->constrained('puestos_familias');
            $table->foreignId('puesto_subfamilia_id')->nullable()->constrained('puestos_subfamilias');
            $table->foreignId('puesto_nomenclatura_id')->constrained('puestos_nomenclaturas');
            
            $table->string('puesto_trabajo_otro')->nullable();
            
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
