<?php

namespace App\Repositories;

use App\Models\Agente;
use App\Repositories\BaseRepository;

/**
 * Class AgenteRepository
 * @package App\Repositories
 * @version June 30, 2022, 6:39 pm UTC
*/

class AgenteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'dni',
        'cuil',
        'fecha_nacimiento',
        'letra_nivel',
        'numero_grado'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Agente::class;
    }
}
