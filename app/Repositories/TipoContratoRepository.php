<?php

namespace App\Repositories;

use App\Models\TipoContrato;
use App\Repositories\BaseRepository;

/**
 * Class TipoContratoRepository
 * @package App\Repositories
 * @version January 25, 2023, 3:54 am -03
*/

class TipoContratoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion'
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
        return TipoContrato::class;
    }
}
