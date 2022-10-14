<?php

namespace Database\Factories;

use App\Models\Evaluacion;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PlantaPermanente;

class EvaluacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evaluacion::class;

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
            'planta_permanentes_id' => $plantaPermanente->id,
            'fecha_desde' => $this->faker->date('Y-m-d'),
            'fecha_hasta' => $this->faker->date('Y-m-d'),
            'nivel_formulario' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'puntaje' => $this->faker->numberBetween(0, 999),
            'calificacion' => $this->faker->numberBetween(0, 999),
            'fue_utilizada' => $this->faker->boolean,
            'tiene_bonificacion' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s')
            
        ];
    }
}
