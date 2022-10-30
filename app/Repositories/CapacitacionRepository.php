<?php

namespace App\Repositories;

use App\Models\Capacitacion;
use App\Repositories\BaseRepository;

/**
 * Class CapacitacionRepository
 * @package App\Repositories
 * @version October 3, 2022, 9:46 am -03
*/

class CapacitacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'apto_tramo',
        'corrimiento_grado',
        'fue_utilizada',
        'tramo',
        'nivel',
        'agrupamiento',
        'perfiles',
        'saldo',
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
        return Capacitacion::class;
    }
}
