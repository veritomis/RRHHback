<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Profesione;
use App\Models\Titulo;

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
        
        $profesione = Profesione::first();
        if (!$profesione) {
            $profesione = Profesione::factory()->create();
        }

        $titulo = Titulo::first();
        if (!$titulo) {
            $titulo = Titulo::factory()->create();
        }

        return [
            'id_agente' => $this->faker->numberBetween(0, 999),
            'fecha' => $this->faker->date('Y-m-d'),
            'fecha_inicial' => $this->faker->date('Y-m-d'),
            'fecha_fin' => $this->faker->date('Y-m-d'),
            'numero_gedo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'antiguedad_total' => $this->faker->date('Y-m-d'),
            'letra_nivel' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_grado' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'compensacion_transitoria' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'profesion_id' => $profesione->id,
            'titulo_id' => $titulo->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
