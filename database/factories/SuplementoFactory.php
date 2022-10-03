<?php

namespace Database\Factories;

use App\Models\Suplemento;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Carrera;

class SuplementoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suplemento::class;

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
            'nombre_suplemento' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'porcentaje' => $this->faker->numberBetween(0, 9223372036854775807),
            'fecha_asignacion' => $this->faker->date('Y-m-d'),
            'carrera_id' => $carrera->id,
            'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
