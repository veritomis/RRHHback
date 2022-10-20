<?php

namespace Database\Factories;

use App\Models\AsistenciaMedica;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Agente;

class AsistenciaMedicaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AsistenciaMedica::class;

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
            'historia_clinica' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'tipo_licencia' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'diagnostico' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'tratamiento' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'estudio_complementario' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'numero_nota_realizada' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'imagen_url' => $this->faker->text($this->faker->numberBetween(5, 50)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
