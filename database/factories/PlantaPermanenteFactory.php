<?php

namespace Database\Factories;

use App\Models\PlantaPermanente;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Agente;

class PlantaPermanenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlantaPermanente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $agente = Agente::first();
        if (!$agente) {
            $agente = Agente::factory()->create();
        }

        return [
            'agente_id' => $agente->id,
            'letra_nivel' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_grado' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'tramo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'agrupamiento' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'modalidad_vinculacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'estado_agente' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'funcion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'ejercicio' => $this->faker->date('Y-m-d'),
            'numero_expediente' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'estado_expediente' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_formulario' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nivel_formulario' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'calificacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'puntaje' => $this->faker->numberBetween(0, 999),
            'evaluador' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'area_id' => $this->faker->numberBetween(0, 999),
            'unidad_analisis' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'notificacion' => $this->faker->boolean,
            'numero_notificacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'observacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'corrimiento_grado' => $this->faker->boolean,
            'numero_expediente_grado' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'corrimiento_agrupamiento' => $this->faker->boolean,
            'numero_expediente_agrupacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
