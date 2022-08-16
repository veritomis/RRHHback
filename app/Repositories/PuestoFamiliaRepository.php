<?php

namespace App\Repositories;

use App\Models\PuestoFamilia;
use App\Repositories\BaseRepository;

/**
 * Class PuestoFamiliaRepository
 * @package App\Repositories
 * @version August 10, 2022, 2:24 am -03
*/

class PuestoFamiliaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'puesto_grupo_id'
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
        return ['puestoGrupo','puestosSubfamilias','puestosNomenclaturas'];
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PuestoFamilia::class;
    }
}
