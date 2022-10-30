<?php

namespace App\Repositories;

use App\Models\VinculacionLaboral;
use App\Repositories\BaseRepository;

/**
 * Class VinculacionLaboralRepository
 * @package App\Repositories
 * @version July 26, 2022, 5:07 am UTC
*/

class VinculacionLaboralRepository extends BaseRepository
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
        return VinculacionLaboral::class;
    }
}
