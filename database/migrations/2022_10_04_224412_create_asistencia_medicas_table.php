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
        Schema::create('asistencia_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agente_id')->constrained('agentes');

            $table->string('historia_clinica')->index();
            $table->string('tipo_licencia')->index();
            $table->string('diagnostico')->index();
            $table->string('tratamiento')->index();
            $table->string('estudio_complementario')->index();
            $table->string('numero_nota_realizada')->nullable();
            $table->string('imagen_url');
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
        Schema::dropIfExists('asistencia_medicas');
    }
};
