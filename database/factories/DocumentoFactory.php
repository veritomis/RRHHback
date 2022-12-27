<?php

namespace Database\Factories;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Factories\Factory;


class DocumentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Documento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'archivo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'url' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'ext' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'orden' => $this->faker->numberBetween(0, 999),
            'modelogable_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'modelogable_id' => $this->faker->numberBetween(0, 999),
            'fecha_de_carga' => $this->faker->date('Y-m-d'),
            'fecha_de_emision' => $this->faker->date('Y-m-d'),
            'fecha_de_vencimiento' => $this->faker->date('Y-m-d'),
            'fecha_de_cotejo' => $this->faker->date('Y-m-d'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
