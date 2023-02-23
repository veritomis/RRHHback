<?php

namespace Database\Seeders;

use App\Models\TipoContrato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoContratos = [
            ['nombre' => 'Contratos Ley Marco Dto. 1421/02',                    'descripcion' => 'contratos'],
            ['nombre' => 'Contratos Dto. 1109/2017',                            'descripcion' => 'carreras'],
            ['nombre' => 'Contratos por convenios con Programas y Proyectos con Financiamiento Internacional: PNUD - BID - BIRF',         'descripcion' => 'asistencias'],
            ['nombre' => 'Pasantías Educativas Ley 26.427',                     'descripcion' => 'liquidaciones'],
            ['nombre' => 'Convenios de Asistencia Técnica con Universidades',   'descripcion' => 'legajos']
        ];

        foreach ($tipoContratos as $tipoContrato) {
            TipoContrato::create($tipoContrato);
        }
    }
}
