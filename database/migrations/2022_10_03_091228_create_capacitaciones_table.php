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

            $table->boolean('apto_tramo')->default(0);
            $table->boolean('corrimiento_grado')->default(0);
            $table->boolean('fue_utilizada')->default(0);
            $table->string('tramo')->nullable();
            $table->string('nivel')->nullable();
            $table->string('agrupamiento')->nullable();
            $table->string('perfiles')->nullable();
            $table->string('saldo')->nullable();

            $table->foreignId('planta_permanente_id')->constrained('planta_permanentes');

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
