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

        // create permissions
        // Permission::create(['name' => 'edit post']);
        // Permission::create(['name' => 'delete post']);
        // Permission::create(['name' => 'create post']);


        $permisos = [
            ['name' => 'crear-post', 'guard_name' => 'sanctum'],
            ['name' => 'editar-post', 'guard_name' => 'sanctum'],
            ['name' => 'borrar-post', 'guard_name' => 'sanctum'],
            ['name' => 'consultar-post', 'guard_name' => 'sanctum']
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
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);
    }
}