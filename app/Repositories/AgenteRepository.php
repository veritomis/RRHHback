<?php

namespace App\Repositories;

use App\Models\Agente;
use App\Models\Contrato;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
        return ['contratos', 'contratos.funciones', 'grupo', 'liquidaciones', 'liquidaciones.documentos', 'asistenciaMedicas', 'asistenciaMedicas.documentos'];
    }

    public function create1109($input)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->newInstance($input);
            $model->save();
            $input['agente_id'] = $model->id;
            Contrato::create($input);
            DB::commit();
            return $model;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }
}
