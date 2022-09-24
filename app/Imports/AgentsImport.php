<?php

namespace App\Imports;

use App\Models\Agente;
use Maatwebsite\Excel\Concerns\ToModel;

class AgentsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Agente([
            'primer_nombre'    => $row[1], //dejo el 0 libre para el id?
            'segundo_nombre'   => $row[2],
            'primer_apellido'  => $row[3],
            'segundo_apellido' => $row[4],
            'dni'              => $row[5],
            'cuil'             => $row[6],
            'fecha_nacimiento' => $row[7],
            'letra_nivel'      => $row[8],
            'numero_grado'     => $row[9],
            //'grupo_id'         => $row[10], //lo tiene el usuario para ponerlo en su excel?
        ]);
    }
}


