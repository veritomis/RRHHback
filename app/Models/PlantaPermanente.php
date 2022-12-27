<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="PlantaPermanente",
 *      required={"agente_id", "letra_nivel", "numero_grado", "tramo", "agrupamiento", "modalidad_vinculacion", "estado_agente", "funcion", "ejercicio", "numero_expediente", "estado_expediente", "numero_formulario", "nivel_formulario", "calificacion", "puntaje", "evaluador", "area_id", "unidad_analisis", "notificacion", "observacion", "corrimiento_grado", "numero_expediente_grado", "corrimiento_agrupamiento", "numero_expediente_agrupacion"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
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
 *          property="letra_nivel",
 *          description="letra_nivel",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="numero_grado",
 *          description="numero_grado",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="tramo",
 *          description="tramo",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="agrupamiento",
 *          description="agrupamiento",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="modalidad_vinculacion",
 *          description="modalidad_vinculacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="estado_agente",
 *          description="estado_agente",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="funcion",
 *          description="funcion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="ejercicio",
 *          description="ejercicio",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="numero_expediente",
 *          description="numero_expediente",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="estado_expediente",
 *          description="estado_expediente",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="numero_formulario",
 *          description="numero_formulario",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="nivel_formulario",
 *          description="nivel_formulario",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="calificacion",
 *          description="calificacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="puntaje",
 *          description="puntaje",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="evaluador",
 *          description="evaluador",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
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
 *          property="unidad_analisis",
 *          description="unidad_analisis",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="notificacion",
 *          description="notificacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="numero_notificacion",
 *          description="numero_notificacion",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="observacion",
 *          description="observacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="corrimiento_grado",
 *          description="corrimiento_grado",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="numero_expediente_grado",
 *          description="numero_expediente_grado",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="corrimiento_agrupamiento",
 *          description="corrimiento_agrupamiento",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="numero_expediente_agrupacion",
 *          description="numero_expediente_agrupacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
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
 *      )
 * )
 */
class PlantaPermanente extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'planta_permanentes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'agente_id',
        'letra_nivel',
        'numero_grado',
        'tramo',
        'agrupamiento',
        'modalidad_vinculacion',
        'asistencia',
        'nivel_funcion_ejecutiva',
        'puesto_agente',
        'es_ejecutivo',
        'es_titular',
        'nivel_funcion_ejecutiva',
        'nivel_funcion_ejecutiva_otro'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'agente_id' => 'integer',
        'letra_nivel' => 'string',
        'numero_grado' => 'string',
        'tramo' => 'string',
        'agrupamiento' => 'string',
        'modalidad_vinculacion' => 'string',
        'asistencia' => 'string',
        'nivel_funcion_ejecutiva' => 'string',
        'puesto_agente' => 'string',
        'es_ejecutivo' => 'boolean',
        'es_titular' => 'boolean',
        'nivel_funcion_ejecutiva' => 'string',
        'nivel_funcion_ejecutiva_otro' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'agente_id' => 'required',
        'letra_nivel' => 'required|string|max:255',
        'numero_grado' => 'required|string|max:255',
        'tramo' => 'required|string|max:255',
        'agrupamiento' => 'required|string|max:255',
        'modalidad_vinculacion' => 'required|string|max:255',
        'asistencia' => 'required|string|max:255',
        'nivel_funcion_ejecutiva' => 'nullable|string',
        'puesto_agente' => 'required|string|max:255',
        'es_ejecutivo' => 'required|boolean',
        'es_titular' => 'required|boolean',
        'nivel_funcion_ejecutiva' => 'nullable|string|max:255',
        'nivel_funcion_ejecutiva_otro' => 'nullable|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function agente()
    {
        return $this->belongsTo(\App\Models\Agente::class, 'agente_id');
    }
    
    public function evaluaciones()
    {
        return $this->hasMany(\App\Models\Evaluacion::class, 'planta_permanentes_id');
    }

    public function capacitacion()
    {
        return $this->hasOne(\App\Models\Capacitacion::class, 'planta_permanente_id');
    }

    public function suplemento()
    {
        return $this->hasOne(\App\Models\Suplemento::class, 'planta_permanente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     **/
    public function documentos()
    {
        return $this->morphMany(Documento::class, 'modelogable');
    }
    
}


