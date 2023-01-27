<?php

namespace App\Repositories;

use App\Models\Capacitacion;
use App\Models\PlantaPermanente;
use App\Models\Evaluacion;
use App\Models\Suplemento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class PlantaPermanenteRepository
 * @package App\Repositories
 * @version August 8, 2022, 2:35 pm -03
 */

class PlantaPermanenteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'agente_id',
        'letra_nivel',
        'numero_grado',
        'tramo',
        'agrupamiento',
        'vinculacion_laboral_id',
        'estado_agente',
        'funcion',
        'ejercicio',
        'numero_expediente',
        'estado_expediente',
        'numero_formulario',
        'nivel_formulario',
        'calificacion',
        'puntaje',
        'evaluador',
        'area_id',
        'unidad_analisis',
        'notificacion',
        'numero_notificacion',
        'observacion',
        'corrimiento_grado',
        'numero_expediente_grado',
        'corrimiento_agrupamiento',
        'numero_expediente_agrupacion',
        'nivel_funcion_ejecutiva',
        'nivel_funcion_ejecutiva_otro'
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
        return PlantaPermanente::class;
    }

    public function getIncludes()
    {
        return ['capacitacion','evaluaciones','suplemento', 'documentos'];
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
            $model->fill($input);
            $model->save();

            $input['suplemento']['id'] = !array_key_exists('id', $input['suplemento']) ? null : $input['suplemento']['id'];
            $model->suplemento()->updateOrCreate(['id' => $input['suplemento']['id']] ,$input['suplemento']);

            $input['capacitacion']['id'] = !array_key_exists('id', $input['capacitacion']) ? null : $input['capacitacion']['id'];
            $model->capacitacion()->updateOrCreate(['id' => $input['capacitacion']['id']] ,$input['capacitacion']);

            foreach ($input['evaluaciones'] as $key => $value) {
                $value['id'] = !array_key_exists('id', $value) ? null : $value['id'];
                $model->evaluaciones()->updateOrCreate(['id' => $value['id']],$value);
            }

            $this->saveFile($model,$input['documentos'],'plantaPermanente');
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }

}
