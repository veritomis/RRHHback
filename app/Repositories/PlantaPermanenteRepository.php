<?php

namespace App\Repositories;

use App\Models\PlantaPermanente;
use App\Models\Evaluacion;
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
        'modalidad_vinculacion',
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
        'numero_expediente_agrupacion'
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
        return ['evaluaciones'];
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
            foreach ($input['evaluaciones'] as $key => $value) {
                $model->evaluaciones()->updateOrCreate($value);
            }
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }

}
