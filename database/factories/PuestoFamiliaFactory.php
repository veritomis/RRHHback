<?php

namespace Database\Factories;

use App\Models\PuestoFamilia;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PuestoGrupo;

class PuestoFamiliaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PuestoFamilia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $puestosGrupo = PuestoGrupo::first();
        if (!$puestosGrupo) {
            $puestosGrupo = PuestoGrupo::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'puesto_grupo_id' => $puestosGrupo->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
