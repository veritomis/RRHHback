<?php

namespace Database\Factories;

use App\Models\Asistencia;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Agente;

class AsistenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asistencia::class;

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
            'agente_id' => $agente->id,
            'calendario' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'horario_propuesto' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
