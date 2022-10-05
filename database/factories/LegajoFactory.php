<?php

namespace Database\Factories;

use App\Models\Legajo;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Agente;

class LegajoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Legajo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $agente = Agente::first();
        if (!$agente) {
            $agente = Agente::factory()->create();
        }

        return [
            'baja_tramite' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'nota_gde' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'fecha_baja' => $this->faker->date('Y-m-d'),
            'motivo_baja' => 'Jubilación',
            'agente_id' => $agente->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
