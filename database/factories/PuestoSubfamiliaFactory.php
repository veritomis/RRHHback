<?php

namespace Database\Factories;

use App\Models\PuestoSubfamilia;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PuestoFamilia;
use App\Models\PuestoGrupo;

class PuestoSubfamiliaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PuestoSubfamilia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $puestosFamilia = PuestoFamilia::first();
        if (!$puestosFamilia) {
            $puestosFamilia = PuestoFamilia::factory()->create();
        }

        $puestosGrupo = PuestoGrupo::first();
        if (!$puestosGrupo) {
            $puestosGrupo = PuestoGrupo::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 20)),
            'puesto_grupo_id' => $puestosGrupo->id,
            'puesto_familia_id' => $puestosFamilia->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
