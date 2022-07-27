<?php

namespace App\Repositories;

use App\Models\Contrato;
use App\Repositories\BaseRepository;

/**
 * Class ContratoRepository
 * @package App\Repositories
 * @version July 26, 2022, 5:09 am UTC
*/

class ContratoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_alta',
        'caracter_contrato',
        'tipo_servicio',
        'objetivo_general',
        'objetivo_especifico',
        'actividades_tarea',
        'resultado_parcial_final',
        'estandares_cualitativos_cuantitativos',
        'fecha_obtencion_resultados',
        'horario_propuesto',
        'nivel_educativo',
        'numero_nota_expediente_electronico',
        'numero_resolucion',
        'estado',
        'vinculacion_laboral_id',
        'asistencia_tipo_contratacion_id',
        'agente_id',
        'area_id',
        'titulo_orientacion_id',
        'puesto_trabajo_id',
        'familia_id',
        'sub_familia_id',
        'puesto_nomenclatura_id',
        'funcion_trabajo_id'
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
        return Contrato::class;
    }
}
