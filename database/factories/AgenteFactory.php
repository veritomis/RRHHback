<?php

namespace Database\Factories;

use App\Models\Agente;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Grupo;

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

        $grupo = Grupo::first();
        if (!$grupo) {
            $grupo = Grupo::factory()->create();
        }

        return [
            'primer_nombre' => $this->faker->firstName(),
            'segundo_nombre' => $this->faker->firstName(),
            'primer_apellido' => $this->faker->lastName(),
            'segundo_apellido' => $this->faker->lastName(),
            'dni' => $this->faker->unique()->numberBetween(1000000, 99999999),
            'cuil' => $this->faker->numberBetween(10, 99) . '-' . $this->faker->numberBetween(1000000, 99999999) . '-' . $this->faker->numberBetween(0, 9),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'genero' => $this->faker->randomElement(['F', 'M']),
            'fecha_ingreso_ministerio' => $this->faker->date('Y-m-d'),
            'letra_nivel' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']),
            'numero_grado' => $this->faker->numberBetween(5, 255),
            'grupo_id' => $grupo->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}
