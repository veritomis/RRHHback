<?php

namespace App\Repositories;

use App\Models\Liquidacion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class LiquidacionRepository
 * @package App\Repositories
 * @version October 5, 2022, 5:08 pm -03
*/

class LiquidacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'monto',
        'fecha',
        'agente_id'
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
        return Liquidacion::class;
    }

    public function getIncludes()
    {
        return ['agente','documentos'];
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
            $this->saveFile($model,$input['documentos'],'liquidaciones');
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }
}
