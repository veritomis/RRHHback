<?php

namespace App\Repositories;

use App\Models\Liquidacion;
use App\Repositories\BaseRepository;

/**
 * Class LiquidacionRepository
 * @package App\Repositories
 * @version October 5, 2022, 5:08 pm -03
*/

class LiquidacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'moton',
        'fecha',
        'agente_id'
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
        return Liquidacion::class;
    }
}
