<?php

namespace App\Repositories;

use App\Models\Usuario_grupo;
use App\Repositories\BaseRepository;

/**
 * Class Usuario_grupoRepository
 * @package App\Repositories
 * @version July 19, 2022, 4:35 pm -03
*/

class Usuario_grupoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'grupo_id'
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
        return Usuario_grupo::class;
    }
}
