<?php

namespace Database\Seeders;

use App\Models\TipoTramite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoTramitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoTramites = [
            ['nombre' =>'Alta'],
            ['nombre' =>'Pura'],
            ['nombre' =>'Renovacion'],
            ['nombre' =>'Adenda'],
            ['nombre' =>'Cambio de Nivel'],
            ['nombre' =>'Movilidad Interna'],
            ['nombre' =>'Recategorizacion'],
            ['nombre' =>'Rectificacion'],
            ['nombre' =>'Reasignacion'],
        ];

        foreach ($tipoTramites as $tipoTramite) {
            TipoTramite::create($tipoTramite);
        }
    }
}
