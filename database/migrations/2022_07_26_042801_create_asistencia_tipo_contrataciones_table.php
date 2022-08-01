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
        Schema::create('asistencia_tipo_contrataciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->foreignId('vinculacion_laboral_id')->constrained('vinculaciones_laborales');
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
        Schema::dropIfExists('asistencia_tipo_contrataciones');
    }
};
