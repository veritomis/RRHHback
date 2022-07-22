<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Profesion::factory(10)->create();
        \App\Models\Titulo::factory(10)->create();

        activity()->withoutLogs(function () {
            $this->call([
                PermissionsSeeder::class,
                ModulesSeeder::class,
                AgenteSeeder::class,
            ]);
        });
    }
}
