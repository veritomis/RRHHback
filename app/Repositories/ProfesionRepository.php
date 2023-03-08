<?php

namespace App\Repositories;

use App\Models\Profesion;
use App\Repositories\BaseRepository;

/**
 * Class ProfesionRepository
 * @package App\Repositories
 * @version July 22, 2022, 1:54 pm -03
*/

class ProfesionRepository extends BaseRepository
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Profesion::class;
    }
}
