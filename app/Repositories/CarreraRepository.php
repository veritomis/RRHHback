<?php

namespace App\Repositories;

use App\Models\Carrera;
use App\Repositories\BaseRepository;

/**
 * Class CarreraRepository
 * @package App\Repositories
 * @version July 12, 2022, 3:51 pm -03
*/

class CarreraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_agente',
        'fecha',
        'fecha_inicial',
        'fecha_fin',
        'numero_gedo',
        'antiguedad_puesto',
        'antiguedad_total',
        'compensacion_transitoria',
        'id_profesiones',
        'id_titulos'
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
        return Carrera::class;
    }
}
