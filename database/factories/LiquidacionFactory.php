<?php

namespace Database\Factories;

use App\Models\Liquidacion;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Agente;

class LiquidacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Liquidacion::class;

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
            'moton' => $this->faker->numberBetween(0, 255),
            'fecha' => $this->faker->date('Y-m-d'),
            'agente_id' => $agente->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
