<?php

namespace Database\Factories;

use App\Models\PuestoNomenclatura;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PuestoFamilia;
use App\Models\PuestoGrupo;
use App\Models\PuestoSubfamilia;

class PuestoNomenclaturaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PuestoNomenclatura::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $puestosFamilia = PuestoFamilia::first();
        if (!$puestosFamilia) {
            $puestosFamilia = PuestoFamilia::factory()->create();
        }

        $puestosGrupo = PuestoGrupo::first();
        if (!$puestosGrupo) {
            $puestosGrupo = PuestoGrupo::factory()->create();
        }

        $puestosSubfamilia = PuestoSubfamilia::first();
        if (!$puestosSubfamilia) {
            $puestosSubfamilia = PuestoSubfamilia::factory()->create();
        }

        return [
            'nombre' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'puesto_grupo_id' => $puestosGrupo->id,
            'puesto_familia_id' => $puestosFamilia->id,
            'puesto_subfamilia_id' => $puestosSubfamilia->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
