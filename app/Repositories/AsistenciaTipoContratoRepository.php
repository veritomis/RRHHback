<?php

namespace App\Repositories;

use App\Models\AsistenciaTipoContrato;
use App\Repositories\BaseRepository;

/**
 * Class AsistenciaTipoContratoRepository
 * @package App\Repositories
 * @version July 26, 2022, 5:27 am UTC
*/

class AsistenciaTipoContratoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'vinculacion_laboral_id'
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
        return AsistenciaTipoContrato::class;
    }
}
