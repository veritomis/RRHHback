<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentes', function (Blueprint $table) {
            $table->id('id');
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('dni')->nullable()->unique();
            $table->string('cuil')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo');
            $table->date('fecha_ingreso_ministerio');
            $table->string('letra_nivel')->nullable();
            $table->string('numero_grado')->nullable();
            $table->foreignId('grupo_id')->constrained('grupos')->nullable();

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
        Schema::drop('agentes');
    }
}
