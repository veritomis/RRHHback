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
        'genero',
        'fecha_ingreso_ministerio',
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
        return [
            'contratos',
            'plantaPermanente',
            'plantaPermanente.vinculacionLaboral',
            'contratos.funciones',
            'contratos.tipoContrato',
            'grupo',
            'liquidaciones',
            'liquidaciones.documentos',
            'asistenciaMedicas',
            'asistenciaMedicas.documentos',
            'carreras'
        ];
    }

    public function create1109($input)
    {
        try {
            DB::beginTransaction();

            foreach($input['contrato'] as $key => $value){
                if (ctype_lower($key)) {
                    continue;
                } else {
                    $input['contrato'][$this->camelCaseToSnakeCase($key)]= $input['contrato'][$key];
                    unset($input['contrato'][$key]);
                }
            }

            foreach($input['agente'] as $key => $value){
                if (ctype_lower($key)) {
                    continue;
                } else {
                    $input['agente'][$this->camelCaseToSnakeCase($key)]= $input['agente'][$key];
                    unset($input['agente'][$key]);
                }
            }

            foreach($input as $key => $value){
                if (ctype_lower($key)) {
                    continue;
                } else {
                    $input[$this->camelCaseToSnakeCase($key)]= $input[$key];
                    unset($input[$key]);
                }
            }

            $model = $this->model->newInstance($input['agente']);
            // dd($input);
            $model->save();
            $input['contrato']['agente_id'] = $model->id;
            Contrato::create($input['contrato']);
            DB::commit();
            return $model;
        } catch (\Exception $th) {
            DB::rollBack();
            $this->handleException($th);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    function camelCaseToSnakeCase($string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}
