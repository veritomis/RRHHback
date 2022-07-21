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
            'primer_nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'segundo_nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'primer_apellido' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'segundo_apellido' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'dni' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'cuil' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'letra_nivel' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_grado' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'grupo_id' => $grupo->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            //'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
