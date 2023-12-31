<?php

namespace Database\Factories;

use App\Models\PlantaPermanente;
use Illuminate\Database\Eloquent\Factories\Factory;

class CapacitacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Capacitacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $plantaPermanente = PlantaPermanente::first();
        if (!$plantaPermanente) {
            $plantaPermanente = PlantaPermanente::factory()->create();
        }

        return [
            'apto_tramo' => $this->faker->boolean,
            'corrimiento_grado' => $this->faker->boolean,
            'fue_utilizada' => $this->faker->boolean,
            'tramo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nivel' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'agrupamiento' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'perfiles' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'saldo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'plantaPermanente_id' => $plantaPermanente->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
