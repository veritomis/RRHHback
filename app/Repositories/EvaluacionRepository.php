<?php

namespace App\Repositories;

use App\Models\Evaluacion;
use App\Repositories\BaseRepository;

/**
 * Class EvaluacionRepository
 * @package App\Repositories
 * @version September 29, 2022, 12:59 pm -03
*/

class EvaluacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'planta_permanentes_id',
        'fecha_desde',
        'fecha_hasta',
        'nivel_formulario',
        'puntaje',
        'calificacion',
        'fue_utilizada',
        'tiene_bonificacion'
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
        return Evaluacion::class;
    }
}
