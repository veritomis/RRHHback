<?php

namespace App\Repositories;

use App\Models\Funcion;
use App\Repositories\BaseRepository;

/**
 * Class FuncionRepository
 * @package App\Repositories
 * @version August 28, 2022, 10:54 pm -03
*/

class FuncionRepository extends BaseRepository
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
        return Funcion::class;
    }
}
