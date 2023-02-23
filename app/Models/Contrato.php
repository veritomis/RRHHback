<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Contrato",
 *      required={"tipo_alta", "caracter_contrato", "tipo_servicio", "objetivo_general", "objetivo_especifico", "actividades_tarea", "resultado_parcial_final", "estandares_cualitativos_cuantitativos", "fecha_obtencion_resultados", "horario_propuesto", "nivel_educativo", "numero_nota_expediente_electronico", "numero_resolucion", "estado", "vinculacion_laboral_id", "asistencia_tipo_contratacion_id", "agente_id", "area_id", "titulo_orientacion_id", "puesto_grupo_id", "puesto_familia_id", "puesto_subfamilia_id", "puesto_nomenclatura_id","puesto_trabajo_otro","experiencia_laboral","observacion","otro_requisito","reportar","competencias_laborales_especificas","denominacion_funcion"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="tipo_alta",
 *          description="tipo_alta",
 *          readOnly=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="caracter_contrato",
 *          description="caracter_contrato",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="tipo_servicio",
 *          description="tipo_servicio",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="objetivo_general",
 *          description="objetivo_general",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="objetivo_especifico",
 *          description="objetivo_especifico",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="actividades_tarea",
 *          description="actividades_tarea",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="resultado_parcial_final",
 *          description="resultado_parcial_final",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="competencias_laborales_especificas",
 *          description="competencias_laborales_especificas",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="denominacion_funcion",
 *          description="denominacion_funcion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="estandares_cualitativos_cuantitativos",
 *          description="estandares_cualitativos_cuantitativos",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="fecha_obtencion_resultados",
 *          description="fecha_obtencion_resultados",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="horario_propuesto",
 *          description="horario_propuesto",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="nivel_educativo",
 *          description="nivel_educativo",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="numero_nota_expediente_electronico",
 *          description="numero_nota_expediente_electronico",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="numero_resolucion",
 *          description="numero_resolucion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="estado",
 *          description="estado",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="asistencia_tipo_contratacion_id",
 *          description="asistencia_tipo_contratacion_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="agente_id",
 *          description="agente_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="area_id",
 *          description="area_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="titulo_orientacion_id",
 *          description="titulo_orientacion_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="puesto_grupo_id",
 *          description="puesto_grupo_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="puesto_familia_id",
 *          description="puesto_familia_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="puesto_subfamilia_id",
 *          description="puesto_subfamilia_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="puesto_nomenclatura_id",
 *          description="puesto_nomenclatura_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="created_at",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="puesto_trabajo_otro",
 *          description="puesto_trabajo_otro",
 *          readOnly=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="experiencia_laboral",
 *          description="experiencia_laboral",
 *          readOnly=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="observacion",
 *          description="observacion",
 *          readOnly=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="otro_requisito",
 *          description="otro_requisito",
 *          readOnly=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="reportar",
 *          description="reportar",
 *          readOnly=false,
 *          type="string"
 *      ),
 * )
 */
class Contrato extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contratos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'tipo_alta',
        'caracter_contrato',
        'nivel_categoria',
        'competencias_laborales_especificas',
        'tipo_servicio',
        'objetivo_general',
        'objetivo_especifico',
        'actividades_tarea',
        'resultado_parcial_final',
        'estandares_cualitativos_cuantitativos',
        'fecha_obtencion_resultados',
        'horario_propuesto',
        'nivel_educativo',
        'numero_nota_expediente_electronico',
        'numero_resolucion',
        'estado',
        'asistencia_tipo_contratacion_id',
        'agente_id',
        'area_id',
        'titulo_orientacion_id',
        'puesto_grupo_id',
        'puesto_familia_id',
        'puesto_subfamilia_id',
        'puesto_nomenclatura_id',
        'puesto_trabajo_otro',
        'experiencia_laboral',
        'observacion',
        'otro_requisito',
        'reportar',
        'denominacion_funcion',
        'ultimo_titulo',
        'secretaria',
        'funcion',
        'nivel_funcion',
        'unidades_retributivas_totales',
        'unidades_retributivas_mensuales',
        'partida',
        'actividad',
        'dedicacion_funcional',
        'resolucion_corta',
        'resolucion_larga',
        'numero_anexo',
        'numero_expediente_gde',
        'numero_loys',
        'fecha_firma_recepcion_expediente',
        'fecha_firma_resolucion',
        'fecha_inicio',
        'fecha_finalizacion',
        'baja_partir_de',
        'fecha_inicio_1109',
        'programa',
        'loys_da_488',
        'loys_de_986',
        'ultimo_termino_referencia',
        'acto_habilitacion_sarh',
        'subsecretaria',
        'dependencia',
        'acto_habilitacion_sarha',
        'tipo_contrato_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_alta' => 'string',
        'caracter_contrato' => 'string',
        'nivel_categoria' => 'string',
        'tipo_servicio' => 'string',
        'objetivo_general' => 'string',
        'objetivo_especifico' => 'string',
        'actividades_tarea' => 'string',
        'resultado_parcial_final' => 'string',
        'estandares_cualitativos_cuantitativos' => 'string',
        'fecha_obtencion_resultados' => 'date',
        'horario_propuesto' => 'string',
        'nivel_educativo' => 'string',
        'numero_nota_expediente_electronico' => 'string',
        'numero_resolucion' => 'string',
        'asistencia_tipo_contratacion_id' => 'integer',
        'agente_id' => 'integer',
        'tipo_contrato_id' => 'integer',
        'area_id' => 'integer',
        'titulo_orientacion_id' => 'integer',
        'puesto_grupo_id' => 'integer',
        'puesto_familia_id' => 'integer',
        'puesto_subfamilia_id' => 'integer',
        'puesto_nomenclatura_id' => 'integer',
        'puesto_trabajo_otro' => 'string',
        'experiencia_laboral' => 'string',
        'observacion' => 'string',
        'otro_requisito' => 'string',
        'reportar' => 'string',
        'competencias_laborales_especificas'=> 'string',
        'denominacion_funcion'=> 'string',
        'ultimo_titulo' => 'string',
        'secretaria' => 'string',
        'funcion' => 'string',
        'nivel_funcion' => 'string',
        'unidades_retributivas_totales' => 'string',
        'unidades_retributivas_mensuales' => 'string',
        'partida' => 'string',
        'actividad' => 'string',
        'dedicacion_funcional' => 'string',
        'resolucion_corta' => 'string',
        'resolucion_larga' => 'string',
        'numero_anexo' => 'string',
        'numero_expediente_gde' => 'string',
        'numero_loys' => 'string',
        'fecha_firma_recepcion_expediente' => 'date',
        'fecha_firma_resolucion' => 'date',
        'fecha_inicio' => 'date',
        'fecha_finalizacion' => 'date',
        'programa' => 'string',
        'estado' => 'string',
        'baja_partir_de' => 'date',
        'fecha_inicio_1109' => 'date',
        'loys_da_488' => 'string',
        'loys_de_986' => 'string',
        'ultimo_termino_referencia' => 'string',
        'acto_habilitacion_sarh' => 'string',
        'subsecretaria' => 'string',
        'dependencia' => 'string',
        'acto_habilitacion_sarha' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_alta' => 'nullable|string|max:255',
        'competencias_laborales_especificas'=> 'required|string|max:255',
        'denominacion_funcion'=> 'nullable|string|max:255',
        // 'caracter_contrato' => 'required|string|max:255',
        // 'nivel_categoria' => 'required|string|max:255',
        // 'tipo_servicio' => 'required|string|max:255',
        // 'objetivo_general' => 'required|string|max:255',
        // 'objetivo_especifico' => 'required|string|max:255',
        // 'actividades_tarea' => 'required|string|max:255',
        // 'resultado_parcial_final' => 'required|string|max:255',
        // 'estandares_cualitativos_cuantitativos' => 'required|string|max:255',
        // 'fecha_obtencion_resultados' => 'required',
        // 'horario_propuesto' => 'required|string|max:255',
        // 'nivel_educativo' => 'required|string|max:255',
        // 'numero_nota_expediente_electronico' => 'required|string|max:255',
        'numero_resolucion' => 'nullable|string|max:255',
        // 'asistencia_tipo_contratacion_id' => 'required',
        // 'agente_id' => 'required|integer',
        // 'area_id' => 'required|integer',
        // 'titulo_orientacion_id' => 'required|integer',
        // 'puesto_grupo_id' => 'required|integer',
        'puesto_familia_id' => 'nullable|integer',
        'tipo_contrato_id' => 'required|integer',
        'puesto_subfamilia_id' => 'nullable|integer',
        'puesto_nomenclatura_id' => 'required|integer',
        'puesto_trabajo_otro' => 'nullable|string',
        'experiencia_laboral' => 'nullable|string',
        'observacion' => 'nullable|string',
        'otro_requisito' => 'nullable|string',
        'reportar' => 'nullable|string',
        'ultimo_titulo' => 'nullable|string',
        'secretaria' => 'nullable|string',
        'funcion' => 'nullable|string',
        'nivel_funcion' => 'nullable|string',
        'unidades_retributivas_totales' => 'nullable|string',
        'unidades_retributivas_mensuales' => 'nullable|string',
        'partida' => 'nullable|string',
        'actividad' => 'nullable|string',
        'dedicacion_funcional' => 'nullable|string',
        'resolucion_corta' => 'nullable|string',
        'resolucion_larga' => 'nullable|string',
        'numero_anexo' => 'nullable|string',
        'numero_expediente_gde' => 'nullable|string',
        'numero_loys' => 'nullable|string',
        'fecha_firma_recepcion_expediente' => 'nullable|date',
        'fecha_firma_resolucion' => 'nullable|date',
        'fecha_inicio' => 'nullable|date',
        'fecha_finalizacion' => 'nullable|date',
        'estado' => 'nullable|string',
        'baja_partir_de' => 'nullable|date',
        'fecha_inicio_1109' => 'nullable|date',
        'programa' => 'nullable|string',
        'loys_da_488' => 'nullable|string',
        'loys_de_986' => 'nullable|string',
        'ultimo_termino_referencia' => 'nullable|string',
        'acto_habilitacion_sarh' => 'nullable|string',
        'subsecretaria' => 'nullable|string',
        'dependencia' => 'nullable|string',
        'acto_habilitacion_sarha' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function asistenciaTipoContratacion()
    {
        return $this->belongsTo(\App\Models\AsistenciaTipoContrato::class, 'asistencia_tipo_contratacion_id');
    }

/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class, 'tipo_contrato_id');
    }

    public function area()
    {
        return $this->belongsTo(\App\Models\Area::class, 'area_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function funciones()
    {
        return $this->belongsToMany(\App\Models\Funcion::class, 'contratos_funciones');
    }
}
