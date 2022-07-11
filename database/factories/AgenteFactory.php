<?php

namespace Database\Factories;

use App\Models\Agente;
use Illuminate\Database\Eloquent\Factories\Factory;


class AgenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'primer_nombre' => fake()->firstName(),
            'segundo_nombre' => fake()->firstName(),
            'primer_apellido' => fake()->lastName(),
            'segundo_apellido' => fake()->lastName(),
            'dni' => fake()->unique()->numberBetween(1000000, 99999999),
            'cuil' => fake()->numberBetween(00, 99) . '-' . fake()->numberBetween(1000000, 99999999) . '-' . fake()->numberBetween(0, 9),
            'fecha_nacimiento' => fake()->dateTimeBetween('-65 years', '-18 years'),
            'letra_nivel' => fake()->randomElement(['A', 'B', 'C', 'D']),
            'numero_grado' => fake()->randomElement([1, 2, 3, 4]),
            'created_at' => fake()->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
