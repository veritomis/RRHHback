<?php

namespace App\Repositories;

use App\Models\AsistenciaMedica;
use App\Repositories\BaseRepository;

/**
 * Class AsistenciaMedicaRepository
 * @package App\Repositories
 * @version October 4, 2022, 10:58 pm -03
*/

class AsistenciaMedicaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'agente_id',
        'historia_clinica',
        'tipo_licencia',
        'diagnostico',
        'tratamiento',
        'estudio_complementario',
        'numero_nota_realizada',
        'imagen_url'
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
        return AsistenciaMedica::class;
    }
}
