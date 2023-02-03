<?php

namespace App\Repositories;

use App\Models\Rol;
use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

/**
 * Class RolRepository
 * @package App\Repositories
 * @version June 25, 2022, 6:24 am UTC
*/

class RolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
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
        return Rol::class;
    }

    public function allPermissions()
    {
        $permisos = [
            'modulos' =>[
                ['name' => 'crear-modulos'],
                ['name' => 'editar-modulos'],
                ['name' => 'borrar-modulos'],
                ['name' => 'consultar-modulos']
              ],
            'agentes' => [
                ['name' => 'crear-agentes'],
                ['name' => 'editar-agentes'],
                ['name' => 'borrar-agentes'],
                ['name' => 'consultar-agentes'],
            ],
            'carreras' => [
              ['name' => 'crear-carreras'],
              ['name' => 'editar-carreras'],
              ['name' => 'borrar-carreras'],
              ['name' => 'consultar-carreras'],
            ],
            'grupos' => [
              ['name' => 'crear-grupos'],
              ['name' => 'editar-grupos'],
              ['name' => 'borrar-grupos'],
              ['name' => 'consultar-grupos'],
            ],
            'titulos' => [
              ['name' => 'crear-titulos'],
              ['name' => 'editar-titulos'],
              ['name' => 'borrar-titulos'],
              ['name' => 'consultar-titulos'],

            ],
            'profesiones' => [
              ['name' => 'crear-profesiones'],
              ['name' => 'editar-profesiones'],
              ['name' => 'borrar-profesiones'],
              ['name' => 'consultar-profesiones'],

            ],
            'contratos' => [
              ['name' => 'crear-contratos'],
              ['name' => 'editar-contratos'],
              ['name' => 'borrar-contratos'],
              ['name' => 'consultar-contratos'],

            ],
            'planta-permanente' => [
              ['name' => 'crear-planta-permanentes'],
              ['name' => 'editar-planta-permanentes'],
              ['name' => 'borrar-planta-permanentes'],
              ['name' => 'consultar-planta-permanentes'],

            ],
            'asistencias' => [
              ['name' => 'crear-asistencias'],
              ['name' => 'editar-asistencias'],
              ['name' => 'borrar-asistencias'],
              ['name' => 'consultar-asistencias'],
            ],
            'legajos' => [
              ['name' => 'crear-legajos'],
              ['name' => 'editar-legajos'],
              ['name' => 'borrar-legajos'],
              ['name' => 'consultar-legajos'],
            ],
            'asistencia-medica' => [
              ['name' => 'crear-asistencia-medicas'],
              ['name' => 'editar-asistencia-medicas'],
              ['name' => 'borrar-asistencia-medicas'],
              ['name' => 'consultar-asistencia-medicas'],
            ],
            'liquidaciones' => [
              ['name' => 'crear-liquidaciones'],
              ['name' => 'editar-liquidaciones'],
              ['name' => 'borrar-liquidaciones'],
              ['name' => 'consultar-liquidaciones'],
            ],
            'tipo-contrato' => [
              ['name' => 'crear-tipo-contratos'],
              ['name' => 'editar-tipo-contratos'],
              ['name' => 'borrar-tipo-contratos'],
              ['name' => 'consultar-tipo-contratos'],
            ],
            'tipo-tramite' => [
              ['name' => 'crear-tipo-tramites'],
              ['name' => 'editar-tipo-tramites'],
              ['name' => 'borrar-tipo-tramites'],
              ['name' => 'consultar-tipo-tramites']
            ]
        ];

        return $permisos;

    }
}
