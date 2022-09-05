<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Contrato",
 *      required={"tipo_alta", "caracter_contrato", "tipo_servicio", "objetivo_general", "objetivo_especifico", "actividades_tarea", "resultado_parcial_final", "estandares_cualitativos_cuantitativos", "fecha_obtencion_resultados", "horario_propuesto", "nivel_educativo", "numero_nota_expediente_electronico", "numero_resolucion", "estado", "vinculacion_laboral_id", "asistencia_tipo_contratacion_id", "agente_id", "area_id", "titulo_orientacion_id", "puesto_grupo_id", "puesto_familia_id", "puesto_subfamilia_id", "puesto_nomenclatura_id", "funcion_trabajo_id","puesto_trabajo_otro","experiencia_laboral","observacion","otro_requisito","reportar"},
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
 *          property="funcion_trabajo_id",
 *          description="funcion_trabajo_id",
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
        'funcion_id',
        'funcion_trabajo_id',
        'puesto_trabajo_otro',
        'experiencia_laboral',
        'observacion',
        'otro_requisito',
        'reportar',
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
        'estado' => 'boolean',
        'asistencia_tipo_contratacion_id' => 'integer',
        'agente_id' => 'integer',
        'area_id' => 'integer',
        'titulo_orientacion_id' => 'integer',
        'puesto_grupo_id' => 'integer',
        'puesto_familia_id' => 'integer',
        'puesto_subfamilia_id' => 'integer',
        'puesto_nomenclatura_id' => 'integer',
        'funcion_id' => 'integer',
        'funcion_trabajo_id' => 'integer',
        'puesto_trabajo_otro' => 'string',
        'experiencia_laboral' => 'string',
        'observacion' => 'string',
        'otro_requisito' => 'string',
        'reportar' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_alta' => 'nullable|string|max:255',
        'caracter_contrato' => 'required|string|max:255',
        'nivel_categoria' => 'required|string|max:255',
        'tipo_servicio' => 'required|string|max:255',
        'objetivo_general' => 'required|string|max:255',
        'objetivo_especifico' => 'required|string|max:255',
        'actividades_tarea' => 'required|string|max:255',
        'resultado_parcial_final' => 'required|string|max:255',
        'estandares_cualitativos_cuantitativos' => 'required|string|max:255',
        'fecha_obtencion_resultados' => 'required',
        'horario_propuesto' => 'required|string|max:255',
        'nivel_educativo' => 'required|string|max:255',
        'numero_nota_expediente_electronico' => 'required|string|max:255',
        'numero_resolucion' => 'nullable|string|max:255',
        'estado' => 'nullable|boolean',
        'asistencia_tipo_contratacion_id' => 'required',
        'agente_id' => 'required|integer',
        'area_id' => 'required|integer',
        'titulo_orientacion_id' => 'required|integer',
        'puesto_grupo_id' => 'required|integer',
        'puesto_familia_id' => 'nullable|integer',
        'puesto_subfamilia_id' => 'nullable|integer',
        'puesto_nomenclatura_id' => 'required|integer',
        'funcion_trabajo_id' => 'required|integer',
        'puesto_trabajo_otro' => 'nullable|string',
        'experiencia_laboral' => 'nullable|string',
        'observacion' => 'nullable|string',
        'otro_requisito' => 'nullable|string',
        'reportar' => 'nullable|string',
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
     * The roles that belong to the user.
     */
    public function funciones()
    {
        return $this->belongsToMany(\App\Models\Funcion::class, 'contratos_funciones');
    }
}
