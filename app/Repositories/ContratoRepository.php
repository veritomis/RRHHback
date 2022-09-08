<?php

namespace App\Repositories;

use App\Models\Contrato;
use App\Models\Funcion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
        'nivel_categoria',
        'competetencias_laborales_especificas',
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
        'asistencia_tipo_contratacion_id',
        'agente_id',
        'area_id',
        'titulo_orientacion_id',
        'puesto_grupo_id',
        'puesto_familia_id',
        'puesto_subfamilia_id',
        'puesto_nomenclatura_id',
        'puesto_trabajo_otro',
        'experiencia_laboral',
        'observacion',
        'otro_requisito',
        'reportar',
        'denominacion_funcion'
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

    public function getIncludes()
    {
        return ['funciones'];
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();
            $query = $this->model->newQuery();
            $model = $query->findOrFail($id);
            $funciones = $this->createFuncion($input['funciones']);
            $model->fill($input);
            $model->save();
            $model->funciones()->sync($funciones);
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }

    public function createFuncion($inputs)
    {
        $arrary = [];
        foreach ($inputs as $key => $value) {
            $arrary[] = Funcion::updateOrCreate(['id' => $value['id']],$value)->id;
        }

        return $arrary;
    }
}
