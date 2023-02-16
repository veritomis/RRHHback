<?php

namespace App\Repositories;

use App\Models\TipoTramite;
use App\Repositories\BaseRepository;

/**
 * Class TipoTramiteRepository
 * @package App\Repositories
 * @version January 25, 2023, 4:49 am -03
*/

class TipoTramiteRepository extends BaseRepository
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
        return TipoTramite::class;
    }
}
