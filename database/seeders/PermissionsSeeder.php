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

            //Asistencia Medica
            ['name' => 'crear-asistencia-medica', 'guard_name' => 'sanctum'],
            ['name' => 'editar-asistencia-medica', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-asistencia-medica', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-asistencia-medica', 'guard_name' => 'sanctum'],

            //Agentes
            ['name' => 'crear-agentes', 'guard_name' => 'sanctum'],
            ['name' => 'editar-agentes', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-agentes', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-agentes', 'guard_name' => 'sanctum']
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