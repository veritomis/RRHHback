<?php

namespace App\Repositories;

use App\Models\Grupo;
use App\Repositories\BaseRepository;

/**
 * Class GrupoRepository
 * @package App\Repositories
 * @version July 19, 2022, 4:34 pm -03
*/

class GrupoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_grupo'
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
        return Grupo::class;
    }
}
