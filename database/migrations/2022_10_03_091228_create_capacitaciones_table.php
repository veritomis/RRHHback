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
        Schema::create('capacitaciones', function (Blueprint $table) {
            $table->id();

            $table->boolean('apto_tramo');
            $table->boolean('corrimiento_grado');
            $table->boolean('fue_utilizada');
            $table->string('tramo')->nullable();
            $table->string('nivel')->nullable();
            $table->string('agrupamiento')->nullable();
            $table->string('perfiles')->nullable();
            $table->string('saldo')->nullable();
            
            $table->foreignId('carrera_id')->constrained('carreras');

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
        Schema::dropIfExists('capacitaciones');
    }
};
