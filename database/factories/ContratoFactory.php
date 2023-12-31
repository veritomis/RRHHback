<?php

namespace Database\Factories;

use App\Models\Agente;
use App\Models\Area;
use App\Models\Contrato;
use App\Models\AsistenciaTipoContrato;
use App\Models\Funcion;
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

        $area = Area::first();
        if (!$area) {
            $area = Area::factory()->create();
        }
        
        // $funcion = Funcion::first();
        // if (!$funcion) {
        //     $funcion = Funcion::factory()->create();
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
            'tipo_contrato_id' => $this->faker->numberBetween(1, 5),
            'tipo_tramite_id' => $this->faker->numberBetween(1, 5),
            'competencias_laborales_especificas' => 'Deseable',
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
            'asistencia_tipo_contratacion_id' => $asistenciaTipoContratacione->id,
            'agente_id' => $agente->id,
            'area_id' => $area->id,
            'titulo_orientacion_id' => $this->faker->numberBetween(0, 999),
            'puesto_grupo_id' => $puestoGrupo->id,
            'puesto_familia_id' => $puestoFamilia->id,
            'puesto_subfamilia_id' => $puestoSubfamilia->id,
            'puesto_nomenclatura_id' => $puestoNomenclatura->id,

            'ultimo_titulo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'secretaria' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'funcion' => $this->faker->numberBetween(1, 3),
            'nivel_funcion' => $this->faker->numberBetween(1, 5),
            'unidades_retributivas_totales' => $this->faker->numberBetween(1, 100),
            'unidades_retributivas_mensuales' => $this->faker->numberBetween(1, 100),
            'partida' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'actividad' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'dedicacion_funcional' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'resolucion_corta' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'resolucion_larga' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_anexo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_expediente_gde' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'numero_loys' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'fecha_firma_recepcion_expediente' => $this->faker->date('Y-m-d H:i:s'),
            'fecha_firma_resolucion' => $this->faker->date('Y-m-d H:i:s'),

            'fecha_inicio'=> $this->faker->date('Y-m-d H:i:s'),
            'fecha_finalizacion'=> $this->faker->date('Y-m-d H:i:s'),
            'estado'=> $this->faker->text($this->faker->numberBetween(5, 255)),
            'baja_partir_de'=> $this->faker->date('Y-m-d H:i:s'),
            'fecha_inicio_1109'=> $this->faker->date('Y-m-d H:i:s'),
            'loys_da_488' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'loys_de_986' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'ultimo_termino_referencia' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'acto_habilitacion_sarh' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'subsecretaria' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'dependencia' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'acto_habilitacion_sarha' => $this->faker->text($this->faker->numberBetween(5, 255)),

            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
