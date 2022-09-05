<?php

namespace App\Repositories;

use App\Models\PuestoGrupo;
use App\Repositories\BaseRepository;

/**
 * Class PuestoGrupoRepository
 * @package App\Repositories
 * @version August 10, 2022, 2:18 am -03
*/

class PuestoGrupoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
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

    public function getIncludes()
    {
        return ['puestosFamilias','puestosSubfamilias','puestosNomenclaturas'];
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PuestoGrupo::class;
    }
}
