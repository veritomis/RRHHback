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
            $table->enum('tipo_alta', ['Alta','Pura', 'Renovacion','Adenda','Cambio de Nivel','Movilidad Interna','Recategorizacion','Rectificacion','Reasignacion'])->nullable();
            $table->enum('caracter_contrato', ['Estacional', 'Transitorio']);
            $table->enum('nivel_categoria', ['A','B','C','D','E','F']);
            $table->string('tipo_servicio')->nullable();
            $table->string('objetivo_general')->nullable();
            $table->string('objetivo_especifico')->nullable();
            $table->string('actividades_tarea')->nullable();
            $table->string('resultado_parcial_final')->nullable();
            $table->string('estandares_cualitativos_cuantitativos')->nullable();
            $table->date('fecha_obtencion_resultados')->nullable();
            $table->string('horario_propuesto')->nullable();
            $table->string('nivel_educativo')->nullable();
            $table->string('numero_nota_expediente_electronico')->nullable();
            $table->string('numero_resolucion')->nullable();
            // $table->boolean('estado')->nullable();
            $table->foreignId('asistencia_tipo_contratacion_id')->nullable()->constrained('asistencia_tipo_contrataciones');
            $table->foreignId('agente_id')->constrained('agentes');
            $table->foreignId('tipo_contrato_id')->nullable()->constrained('tipo_contratos');
            $table->foreignId('tipo_tramite_id')->nullable()->constrained('tipo_tramites');
            $table->foreignId('area_id')->nullable()->constrained('areas');
            $table->integer('titulo_orientacion_id')->nullable();
            $table->foreignId('puesto_grupo_id')->nullable()->constrained('puestos_grupos');
            $table->foreignId('puesto_familia_id')->nullable()->constrained('puestos_familias');
            $table->foreignId('puesto_subfamilia_id')->nullable()->constrained('puestos_subfamilias');
            $table->foreignId('puesto_nomenclatura_id')->nullable()->constrained('puestos_nomenclaturas');
            $table->string('puesto_trabajo_otro')->nullable();
            $table->text('experiencia_laboral')->nullable();
            $table->text('observacion')->nullable();
            $table->text('otro_requisito')->nullable();
            $table->text('reportar')->nullable();
            $table->enum('competencias_laborales_especificas', ['Deseable','Excluyente'])->nullable();
            $table->text('denominacion_funcion')->nullable();

            $table->string('ultimo_titulo')->nullable();                           //"adfasd",
            $table->string('secretaria')->nullable();                             //"asdasd",
            $table->string('funcion')->nullable();                                //"1",
            $table->string('nivel_funcion')->nullable();                           //"2",
            $table->string('unidades_retributivas_totales')->nullable();            //"23",
            $table->string('unidades_retributivas_mensuales')->nullable();          //"40",
            $table->string('partida')->nullable();                                //"ASDASD",
            $table->string('actividad')->nullable();                              //"ASDAS",
            $table->string('dedicacion_funcional')->nullable();                    //"ASDA",
            $table->string('resolucion_corta')->nullable();                        //"ASD",
            $table->string('resolucion_larga')->nullable();                        //"QWE3",
            $table->string('numero_anexo')->nullable();                            //"asdasd",
            $table->string('numero_expediente_gde')->nullable();                    //"asdasd",
            $table->string('numero_loys')->nullable();                             //"asdasd",
            $table->date('fecha_firma_recepcion_expediente')->nullable();          //"2023-01-23",
            $table->date('fecha_firma_resolucion')->nullable();                   //"2023-01-18

            // 1109
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->date('baja_partir_de')->nullable();
            $table->date('fecha_inicio_1109')->nullable();
            $table->string('programa')->nullable();
            $table->string('estado')->nullable();
            $table->string('loys_da_488')->nullable();
            $table->string('loys_de_986')->nullable();
            $table->string('ultimo_termino_referencia')->nullable();
            $table->string('acto_habilitacion_sarh')->nullable();
            $table->string('subsecretaria')->nullable();
            $table->string('dependencia')->nullable();
            $table->string('acto_habilitacion_sarha')->nullable();

            //relaciones
            // $table->integer('vinculacion_laboral_id');
            // $table->integer('asistenacia_tipo_contratacion_id');
            // $table->foreignId('vinculacion_laboral_id')->constrained('vinculaciones_laborales');

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
