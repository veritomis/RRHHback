<?php

namespace Database\Factories;

use App\Models\AsistenciaTipoContrato;
use App\Models\VinculacionLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\VinculacionesLaborale;

class AsistenciaTipoContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AsistenciaTipoContrato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $vinculacionesLaborale = VinculacionLaboral::first();
        if (!$vinculacionesLaborale) {
            $vinculacionesLaborale = VinculacionLaboral::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'vinculacion_laboral_id' => $vinculacionesLaborale->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
