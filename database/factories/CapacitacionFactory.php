<?php

namespace Database\Factories;

use App\Models\Capacitacion;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Carrera;

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
        
        $carrera = Carrera::first();
        if (!$carrera) {
            $carrera = Carrera::factory()->create();
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
            'carrera_id' => $carrera->id,
            'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
