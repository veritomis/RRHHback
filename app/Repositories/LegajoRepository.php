<?php

namespace App\Repositories;

use App\Models\Legajo;
use App\Repositories\BaseRepository;

/**
 * Class LegajoRepository
 * @package App\Repositories
 * @version October 4, 2022, 10:58 pm -03
*/

class LegajoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'baja_tramite',
        'nota_gde',
        'fecha_baja',
        'motivo_baja',
        'agente_id'
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
        return Legajo::class;
    }
}
