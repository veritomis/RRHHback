<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;


class CarreraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carrera::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id_agente' => $this->faker->numberBetween(0, 999),
            'fecha' => $this->faker->date('Y-m-d'),
            'fecha_inicial' => $this->faker->date('Y-m-d'),
            'fecha_fin' => $this->faker->date('Y-m-d'),
            'numero_gedo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'antiguedad_puesto' => $this->faker->date('Y-m-d'),
            'antiguedad_total' => $this->faker->date('Y-m-d'),
            'compensacion_transitoria' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'id_profesiones' => $this->faker->numberBetween(0, 999),
            'id_titulos' => $this->faker->numberBetween(0, 999),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
