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
        
            Schema::create('agente', function (Blueprint $table) {
                $table->int('agente_id');
                $table->int('mb_grupo_id');
                $table->varchar('primer_nombre')->nullable();
                $table->varchar('segundo_nombre')->nullable();
                $table->varchar('primer_apellido')->nullable();
                $table->varchar('segundo_apellido')->nullable();
                $table->int('dni')->nullable();
                $table->varchar('cuil')->nullable();
                $table->date('fecha_de_nacimiento')->nullable();
                $table->varchar('letra')->nullable();
                $table->int('numero')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    };
