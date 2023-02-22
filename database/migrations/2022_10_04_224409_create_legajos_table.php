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
        Schema::create('legajos', function (Blueprint $table) {
            $table->id();
            $table->string('baja_tramite')->index();
            $table->string('nota_gde')->index();
            $table->date('fecha_baja');
            $table->enum('motivo_baja', ['Jubilación', 'Fallecimiento','Renuncia','MOBI Movilidad Interministerial','Finalización de Contrato'])->default('Jubilación');
            $table->foreignId('agente_id')->constrained('agentes');
            $table->softDeletes();
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
        Schema::dropIfExists('legajos');
    }
};
