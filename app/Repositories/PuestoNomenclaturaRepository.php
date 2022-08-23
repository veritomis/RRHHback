<?php

namespace App\Repositories;

use App\Models\PuestoNomenclatura;
use App\Repositories\BaseRepository;

/**
 * Class PuestoNomenclaturaRepository
 * @package App\Repositories
 * @version August 10, 2022, 2:29 am -03
*/

class PuestoNomenclaturaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'puesto_grupo_id',
        'puesto_familia_id',
        'puesto_subfamilia_id'
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
        return ['puestoGrupo','puestoFamilia','puestoSubfamilia'];
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PuestoNomenclatura::class;
    }
}
