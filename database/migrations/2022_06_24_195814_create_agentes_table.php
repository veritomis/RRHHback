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
            $table->string('dni')->nullable();
            $table->string('cuil')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->date('fecha_ingreso_ministerio')->nullable();
            $table->string('letra_nivel')->nullable();
            $table->string('numero_grado')->nullable();

            $table->string('estado_civil')->nullable();
            $table->string('domi')->nullable();
            $table->string('cpos')->nullable();
            $table->string('loc_id')->nullable();
            $table->string('loc_descripcion')->nullable();
            $table->string('prov_id')->nullable();
            $table->string('prv_descripcion')->nullable();
            $table->string('telefono')->nullable();

            $table->foreignId('grupo_id')->nullable()->constrained('grupos');

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
