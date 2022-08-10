<?php

namespace App\Repositories;

use App\Models\PuestoSubfamilia;
use App\Repositories\BaseRepository;

/**
 * Class PuestoSubfamiliaRepository
 * @package App\Repositories
 * @version August 10, 2022, 2:26 am -03
*/

class PuestoSubfamiliaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'puesto_grupo_id',
        'puesto_familia_id'
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
        return PuestoSubfamilia::class;
    }
}
