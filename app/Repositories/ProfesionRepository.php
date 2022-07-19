<?php

namespace App\Repositories;

use App\Models\Profesion;
use App\Repositories\BaseRepository;

/**
 * Class ProfesionRepository
 * @package App\Repositories
 * @version July 19, 2022, 4:27 pm -03
*/

class ProfesionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre_profesion'
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
