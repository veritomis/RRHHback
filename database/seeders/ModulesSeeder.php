<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulos = [
            ['nombre' => 'Contratos',          'slug' => 'contratos'],
            ['nombre' => 'Carreras',           'slug' => 'carreras'],
            ['nombre' => 'Asistencia',         'slug' => 'asistencias'],
            ['nombre' => 'Liquidaciones',      'slug' => 'liquidaciones'],
            ['nombre' => 'Legajo',             'slug' => 'legajos'],
            ['nombre' => 'Planta Permanente',  'slug' => 'planta-permanente'],
            ['nombre' => 'Asistencia Medica',  'slug' => 'asistencia-medica']
        ];

        foreach ($modulos as $modulo) {
            Module::create($modulo);
        }
    }
}
