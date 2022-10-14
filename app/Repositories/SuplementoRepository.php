<?php

namespace App\Repositories;

use App\Models\Suplemento;
use App\Repositories\BaseRepository;

/**
 * Class SuplementoRepository
 * @package App\Repositories
 * @version October 3, 2022, 9:46 am -03
*/

class SuplementoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_suplemento',
        'porcentaje',
        'fecha_asignacion',
        'carrera_id'
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
        return Suplemento::class;
    }
}
