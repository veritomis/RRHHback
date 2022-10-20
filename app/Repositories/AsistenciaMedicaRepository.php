<?php

namespace App\Repositories;

use App\Models\AsistenciaMedica;
use App\Models\Documento;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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

    public function getIncludes()
    {
        return ['documentos'];
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
            $this->saveFile($model,$input['documentos'],'asistenciaMedica');
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }
}
