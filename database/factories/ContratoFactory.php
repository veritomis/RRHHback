<?php

namespace Database\Factories;

use App\Models\Contrato;
use App\Models\AsistenciaTipoContrato;
use App\Models\VinculacionLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contrato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $asistenciaTipoContratacione = AsistenciaTipoContrato::first();
        if (!$asistenciaTipoContratacione) {
            $asistenciaTipoContratacione = AsistenciaTipoContrato::factory()->create();
        }

        $vinculacionesLaborale = VinculacionLaboral::first();
        if (!$vinculacionesLaborale) {
            $vinculacionesLaborale = VinculacionLaboral::factory()->create();
        }

        return [
            'tipo_alta' => 'Pura',
            'caracter_contrato' => $this->faker->boolean,
            'tipo_servicio' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'objetivo_general' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'objetivo_especifico' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'actividades_tarea' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'resultado_parcial_final' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'estandares_cualitativos_cuantitativos' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'fecha_obtencion_resultados' => $this->faker->date('Y-m-d'),
            'horario_propuesto' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'nivel_educativo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_nota_expediente_electronico' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_resolucion' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'estado' => $this->faker->boolean,
            'vinculacion_laboral_id' => $vinculacionesLaborale->id,
            'asistencia_tipo_contratacion_id' => $asistenciaTipoContratacione->id,
            'agente_id' => $this->faker->numberBetween(0, 999),
            'area_id' => $this->faker->numberBetween(0, 999),
            'titulo_orientacion_id' => $this->faker->numberBetween(0, 999),
            'puesto_trabajo_id' => $this->faker->numberBetween(0, 999),
            'familia_id' => $this->faker->numberBetween(0, 999),
            'sub_familia_id' => $this->faker->numberBetween(0, 999),
            'puesto_nomenclatura_id' => $this->faker->numberBetween(0, 999),
            'funcion_trabajo_id' => $this->faker->numberBetween(0, 999),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}