<?php

namespace App\Repositories;

use App\Models\Asitencia;
use App\Repositories\BaseRepository;

/**
 * Class AsitenciaRepository
 * @package App\Repositories
 * @version October 3, 2022, 12:22 pm -03
*/

class AsitenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Asitencia::class;
    }
}
