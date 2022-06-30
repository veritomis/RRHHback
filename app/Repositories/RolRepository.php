<?php

namespace App\Repositories;

use App\Models\Rol;
use App\Repositories\BaseRepository;

/**
 * Class RolRepository
 * @package App\Repositories
 * @version June 25, 2022, 6:24 am UTC
*/

class RolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
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
        return Rol::class;
    }
}
