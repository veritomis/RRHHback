<?php

namespace App\Repositories;

use App\Models\Carrera;
use App\Repositories\BaseRepository;

/**
 * Class CarreraRepository
 * @package App\Repositories
 * @version July 18, 2022, 4:36 pm -03
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
        'antiguedad_total',
        'letra_nivel',
        'numero_grado',
        'compensacion_transitoria',
        'profesion_id',
        'titulo_id',        
        'nivel_educativo',
        'nivel_educativo_otro'
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

    public function getIncludes()
    {
        return ['funciones'];
    }
}
