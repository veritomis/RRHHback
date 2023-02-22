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
        Schema::create('puestos_subfamilias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->foreignId('puesto_grupo_id')->nullable()->constrained('puestos_grupos');
            $table->foreignId('puesto_familia_id')->nullable()->constrained('puestos_familias');
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
        Schema::dropIfExists('puestos_subfamilias');
    }
};
