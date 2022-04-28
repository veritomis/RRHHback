<?php

namespace App\Repositories;

use App\Models\Estado;
use App\Repositories\BaseRepository;

/**
 * Class EstadoRepository
 * @package App\Repositories
 * @version April 28, 2022, 4:23 am UTC
*/

class EstadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'siglas',
        'capital',
        'poblacion'
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
        return Estado::class;
    }
}
