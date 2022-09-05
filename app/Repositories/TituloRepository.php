<?php

namespace App\Repositories;

use App\Models\Titulo;
use App\Repositories\BaseRepository;

/**
 * Class TituloRepository
 * @package App\Repositories
 * @version July 19, 2022, 4:26 pm -03
*/

class TituloRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo_orientacion',
        'orientacion'
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
        return Titulo::class;
    }
}
