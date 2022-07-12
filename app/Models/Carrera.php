<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Carrera",
 *      required={"id_agente", "fecha", "fecha_inicial", "fecha_fin", "numero_gedo", "antiguedad_puesto", "antiguedad_total", "compensacion_transitoria", "id_profesiones", "id_titulos"},
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
 *          property="antiguedad_puesto",
 *          description="antiguedad_puesto",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
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
 *          property="compensacion_transitoria",
 *          description="compensacion_transitoria",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="id_profesiones",
 *          description="id_profesiones",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="id_titulos",
 *          description="id_titulos",
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
        'antiguedad_puesto',
        'antiguedad_total',
        'compensacion_transitoria',
        'id_profesiones',
        'id_titulos'
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
        'antiguedad_puesto' => 'date',
        'antiguedad_total' => 'date',
        'compensacion_transitoria' => 'string',
        'id_profesiones' => 'integer',
        'id_titulos' => 'integer'
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
        'antiguedad_puesto' => 'required',
        'antiguedad_total' => 'required',
        'compensacion_transitoria' => 'required|string|max:255',
        'id_profesiones' => 'required',
        'id_titulos' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
