<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [
            ['name' => 'crear-post', 'guard_name' => 'sanctum'],
            ['name' => 'editar-post', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-post', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-post', 'guard_name' => 'sanctum'],

            //Modulos
            ['name' => 'crear-modulos', 'guard_name' => 'sanctum'],
            ['name' => 'editar-modulos', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-modulos', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-modulos', 'guard_name' => 'sanctum'],

            //Agentes
            ['name' => 'crear-agentes', 'guard_name' => 'sanctum'],
            ['name' => 'editar-agentes', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-agentes', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-agentes', 'guard_name' => 'sanctum'],

            //Carreras
            ['name' => 'crear-carreras', 'guard_name' => 'sanctum'],
            ['name' => 'editar-carreras', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-carreras', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-carreras', 'guard_name' => 'sanctum'],

            //Grupos
            ['name' => 'crear-grupos', 'guard_name' => 'sanctum'],
            ['name' => 'editar-grupos', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-grupos', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-grupos', 'guard_name' => 'sanctum'],

            //Titulos
            ['name' => 'crear-titulos', 'guard_name' => 'sanctum'],
            ['name' => 'editar-titulos', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-titulos', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-titulos', 'guard_name' => 'sanctum'],

            //Profesiones
            ['name' => 'crear-profesiones', 'guard_name' => 'sanctum'],
            ['name' => 'editar-profesiones', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-profesiones', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-profesiones', 'guard_name' => 'sanctum'],

            //Contratos
            ['name' => 'crear-contratos', 'guard_name' => 'sanctum'],
            ['name' => 'editar-contratos', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-contratos', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-contratos', 'guard_name' => 'sanctum'],

            //Planta Permanente
            ['name' => 'crear-planta-permanentes', 'guard_name' => 'sanctum'],
            ['name' => 'editar-planta-permanentes', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-planta-permanentes', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-planta-permanentes', 'guard_name' => 'sanctum'],

            //Asistencias
            ['name' => 'crear-asistencias', 'guard_name' => 'sanctum'],
            ['name' => 'editar-asistencias', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-asistencias', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-asistencias', 'guard_name' => 'sanctum'],
            
            //Legajos
            ['name' => 'crear-legajos', 'guard_name' => 'sanctum'],
            ['name' => 'editar-legajos', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-legajos', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-legajos', 'guard_name' => 'sanctum'],

            //Asistencia Medica
            ['name' => 'crear-asistencia-medicas', 'guard_name' => 'sanctum'],
            ['name' => 'editar-asistencia-medicas', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-asistencia-medicas', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-asistencia-medicas', 'guard_name' => 'sanctum'],

            //Liquidacion
            ['name' => 'crear-liquidaciones', 'guard_name' => 'sanctum'],
            ['name' => 'editar-liquidaciones', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-liquidaciones', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-liquidaciones', 'guard_name' => 'sanctum']
        ];

        foreach ($permisos as $permiso) {
            Permission::create($permiso);
        }


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'funsionario','guard_name' => 'sanctum']);
        $role1->givePermissionTo('consultar-post');

        $role2 = Role::create(['name' => 'admin','guard_name' => 'sanctum']);
        $role2->givePermissionTo(Permission::all());

        $role3 = Role::create(['name' => 'Super-Admin','guard_name' => 'sanctum']);
        $role3->givePermissionTo(Permission::all());

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
            'password'=>'epidata01'
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
            'password'=>'epidata01'
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
            'password'=>'epidata01'
        ]);
        $user->assignRole($role3);
    }
}