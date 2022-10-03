<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Profesion::factory(10)->create();
        \App\Models\Titulo::factory(10)->create();
        // \App\Models\VinculacionLaboral::factory(10)->create();
        \App\Models\AsistenciaTipoContrato::factory(10)->create();
        \App\Models\Grupo::factory(10)->create();
        \App\Models\Carrera::factory(10)->create();
        \App\Models\Funcion::factory(5)->create();
        activity()->withoutLogs(function () {
            $this->call([
                PermissionsSeeder::class,
                ModulesSeeder::class,
                AgenteSeeder::class,
                PuestosSeeder::class,
            ]);
        });
        \App\Models\Contrato::factory(10)->create();
        \App\Models\PlantaPermanente::factory(10)->create();
    }
}
