<?php

namespace App\Repositories;

use App\Models\Agente;
use App\Repositories\BaseRepository;

/**
 * Class AgenteRepository
 * @package App\Repositories
 * @version July 18, 2022, 4:35 pm -03
*/

class AgenteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'dni',
        'cuil',
        'fecha_nacimiento',
        'letra_nivel',
        'numero_grado',
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
        return Agente::class;
    }

    public function getIncludes()
    {
        return ['contratos','grupo'];
    }

}
