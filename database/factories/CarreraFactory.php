<?php

namespace Database\Factories;

use App\Models\Carrera;
use App\Models\Profesion;
use App\Models\Titulo;
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
        
        $profesion = Profesion::first();
        if (!$profesion) {
            $profesion = Profesion::factory()->create();
        }

        $titulo = Titulo::first();
        if (!$titulo) {
            $titulo = Titulo::factory()->create();
        }

        return [
            'agente_id' => $this->faker->unique()->numberBetween(1, 100),
            'fecha' => $this->faker->date('Y-m-d'),
            'fecha_inicial' => $this->faker->date('Y-m-d'),
            'fecha_fin' => $this->faker->date('Y-m-d'),
            'numero_gedo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'antiguedad_total' => $this->faker->date('Y-m-d'),
            'letra_nivel' => $this->faker->numberBetween(1, 2),
            'numero_grado' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'compensacion_transitoria' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'profesion_id' => $profesion->id,
            'titulo_id' => $titulo->id,
            'nivel_educativo' => 'Primario completo',
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
