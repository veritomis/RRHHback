<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Carrera",
 *      required={"id_agente", "fecha", "fecha_inicial", "fecha_fin", "numero_gedo", "antiguedad_total", "compensacion_transitoria", "profesion_id", "titulo_id"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="id_agente",
 *          description="id_agente",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="fecha",
 *          description="fecha",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="fecha_inicial",
 *          description="fecha_inicial",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="fecha_fin",
 *          description="fecha_fin",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="numero_gedo",
 *          description="numero_gedo",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="antiguedad_total",
 *          description="antiguedad_total",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="letra_nivel",
 *          description="letra_nivel",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="numero_grado",
 *          description="numero_grado",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="compensacion_transitoria",
 *          description="compensacion_transitoria",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="profesion_id",
 *          description="profesion_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="titulo_id",
 *          description="titulo_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="nivel_educativo",
 *          description="nivel_educativo",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="nivel_educativo_otro",
 *          description="nivel_educativo_otro",
 *          readOnly=false,
 *          nullable=true,
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
class Carrera extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'carreras';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id_agente',
        'fecha',
        'fecha_inicial',
        'fecha_fin',
        'numero_gedo',
        'antiguedad_total',
        'letra_nivel',
        'numero_grado',
        'compensacion_transitoria',
        'profesion_id',
        'titulo_id',
        'nivel_educativo',
        'nivel_educativo_otro'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_agente' => 'integer',
        'fecha' => 'date',
        'fecha_inicial' => 'date',
        'fecha_fin' => 'date',
        'numero_gedo' => 'string',
        'antiguedad_total' => 'date',
        'letra_nivel' => 'string',
        'numero_grado' => 'string',
        'compensacion_transitoria' => 'string',
        'profesion_id' => 'integer',
        'titulo_id' => 'integer',
        'nivel_educativo' => 'string',
        'nivel_educativo_otro' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_agente' => 'required',
        'fecha' => 'required',
        'fecha_inicial' => 'required',
        'fecha_fin' => 'required',
        'numero_gedo' => 'required|string|max:255',
        'antiguedad_total' => 'required',
        'letra_nivel' => 'nullable|string|max:255',
        'numero_grado' => 'nullable|string|max:255',
        'compensacion_transitoria' => 'required|string|max:255',
        'profesion_id' => 'required',
        'titulo_id' => 'required',
        'nivel_educativo' => 'required',
        'nivel_educativo_otro' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function profesion()
    {
        return $this->belongsTo(\App\Models\Profesione::class, 'profesion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function titulo()
    {
        return $this->belongsTo(\App\Models\Titulo::class, 'titulo_id');
    }
}
