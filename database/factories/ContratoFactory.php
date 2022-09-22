<?php

namespace Database\Factories;

use App\Models\Agente;
use App\Models\Contrato;
use App\Models\AsistenciaTipoContrato;
use App\Models\PuestoFamilia;
use App\Models\PuestoGrupo;
use App\Models\PuestoNomenclatura;
use App\Models\PuestoSubfamilia;
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

        $agente = Agente::first();
        if (!$agente) {
            $agente = Agente::factory()->create();
        }

        // $vinculacionesLaborale = VinculacionLaboral::first();
        // if (!$vinculacionesLaborale) {
        //     $vinculacionesLaborale = VinculacionLaboral::factory()->create();
        // }

        $puestoGrupo = PuestoGrupo::first();
        if (!$puestoGrupo) {
            $puestoGrupo = PuestoGrupo::factory()->create();
        }

        $puestoFamilia = PuestoFamilia::first();
        if (!$puestoFamilia) {
            $puestoFamilia = PuestoFamilia::factory()->create();
        }
        
        $puestoSubfamilia = PuestoSubfamilia::first();
        if (!$puestoSubfamilia) {
            $puestoSubfamilia = PuestoSubfamilia::factory()->create();
        }

        $puestoNomenclatura = PuestoNomenclatura::first();
        if (!$puestoNomenclatura) {
            $puestoNomenclatura = PuestoNomenclatura::factory()->create();
        }


        return [
            'tipo_alta' => 'Pura',
            'caracter_contrato' => 'Estacional',
            'competetencias_laborales_especificas' => 'Deseable',
            'denominacion_funcion' => $this->faker->text($this->faker->numberBetween(5, 25)),
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
            'asistencia_tipo_contratacion_id' => $asistenciaTipoContratacione->id,
            'agente_id' => $agente->id,
            'area_id' => $this->faker->numberBetween(0, 999),
            'titulo_orientacion_id' => $this->faker->numberBetween(0, 999),
            'puesto_grupo_id' => $puestoGrupo->id,
            'puesto_familia_id' => $puestoFamilia->id,
            'puesto_subfamilia_id' => $puestoSubfamilia->id,
            'puesto_nomenclatura_id' => $puestoNomenclatura->id,

            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
