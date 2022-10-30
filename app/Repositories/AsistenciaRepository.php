<?php

namespace App\Repositories;

use App\Models\Asistencia;
use App\Repositories\BaseRepository;

/**
 * Class AsistenciaRepository
 * @package App\Repositories
 * @version October 4, 2022, 2:27 pm -03
*/

class AsistenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'agente_id',
        'calendario',
        'horario_propuesto'
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
        return Asistencia::class;
    }
}
