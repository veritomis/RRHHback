<?php

namespace Database\Factories;

use App\Models\Titulo;
use Illuminate\Database\Eloquent\Factories\Factory;


class TituloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Titulo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'titulo_orientacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'orientacion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
