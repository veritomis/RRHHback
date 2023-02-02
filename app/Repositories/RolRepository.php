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
                'crear' => 'crear-modulos',
                'editar' => 'editar-modulos',
                'borrar' => 'borrar-modulos',
                'consultar' => 'consultar-modulos'
            ],
            'agentes' => [
                'crear' => 'crear-agentes',
                'editar' => 'editar-agentes',
                'borrar' => 'borrar-agentes',
                'consultar' => 'consultar-agentes'
            ],
            'carreras' => [
                'crear' => 'crear-carreras',
                'editar' => 'editar-carreras',
                'borrar' => 'borrar-carreras',
                'consultar' => 'consultar-carreras'
            ],
            'grupos' => [
                'crear' => 'crear-grupos',
                'editar' => 'editar-grupos',
                'borrar' => 'borrar-grupos',
                'consultar' => 'consultar-grupos'
            ],
            'titulos' => [
                'crear' => 'crear-titulos',
                'editar' => 'editar-titulos',
                'borrar' => 'borrar-titulos',
                'consultar' => 'consultar-titulos'

            ],
            'profesiones' => [
                'crear' => 'crear-profesiones',
                'editar' => 'editar-profesiones',
                'borrar' => 'borrar-profesiones',
                'consultar' => 'consultar-profesiones'

            ],
            'contratos' => [
                'crear' => 'crear-contratos',
                'editar' => 'editar-contratos',
                'borrar' => 'borrar-contratos',
                'consultar' => 'consultar-contratos'

            ],
            'plantaPermanente' => [
                'crear' => 'crear-planta-permanentes',
                'editar' => 'editar-planta-permanentes',
                'borrar' => 'borrar-planta-permanentes',
                'consultar' => 'consultar-planta-permanentes'
            ],
            'asistencias' => [
                'crear' => 'crear-asistencias',
                'editar' => 'editar-asistencias',
                'borrar' => 'borrar-asistencias',
                'consultar' => 'consultar-asistencias'
            ],
            'legajos' => [
                'crear' => 'crear-legajos',
                'editar' => 'editar-legajos',
                'borrar' => 'borrar-legajos',
                'consultar' => 'consultar-legajos'
            ],
            'asistenciaMedica' => [
                'crear' => 'crear-asistencia-medicas',
                'editar' => 'editar-asistencia-medicas',
                'borrar' => 'borrar-asistencia-medicas',
                'consultar' => 'consultar-asistencia-medicas'
            ],
            'liquidacion' => [
                'crear' => 'crear-liquidaciones',
                'editar' => 'editar-liquidaciones',
                'borrar' => 'borrar-liquidaciones',
                'consultar' => 'consultar-liquidaciones'
            ],
            'tipoContratos' => [
                'crear' => 'crear-tipo-contratos',
                'editar' => 'editar-tipo-contratos',
                'borrar' => 'borrar-tipo-contratos',
                'consultar' => 'consultar-tipo-contratos'
            ],
            'tipoTramites' => [
              [
                'crear' => 'crear-tipo-tramites',
                'editar' => 'editar-tipo-tramites',
                'borrar' => 'borrar-tipo-tramites',
                'consultar' => 'consultar-tipo-tramites']
            ]
        ];

        return $permisos;

    }

}
