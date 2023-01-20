<?php

namespace Database\Factories;

use App\Models\PlantaPermanente;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Agente;

class PlantaPermanenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlantaPermanente::class;

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
            'agente_id' => $this->faker->numberBetween(1, 99),
            'letra_nivel' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_grado' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tramo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'agrupamiento' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'modalidad_vinculacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'asistencia' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nivel_funcion_ejecutiva' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'puesto_agente' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'es_ejecutivo' => $this->faker->boolean,
            'es_titular' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}