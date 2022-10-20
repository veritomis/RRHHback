<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Evaluacion",
 *      required={"planta_permanentes_id", "fecha_desde", "fecha_hasta", "nivel_formulario", "puntaje", "calificacion", "fue_utilizada", "tiene_bonificacion"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="planta_permanentes_id",
 *          description="planta_permanentes_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="fecha_desde",
 *          description="fecha_desde",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="fecha_hasta",
 *          description="fecha_hasta",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="nivel_formulario",
 *          description="nivel_formulario",
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
 *          property="calificacion",
 *          description="calificacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="fue_utilizada",
 *          description="fue_utilizada",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="tiene_bonificacion",
 *          description="tiene_bonificacion",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
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
class Evaluacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'evaluaciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'planta_permanentes_id',
        'fecha_desde',
        'fecha_hasta',
        'nivel_formulario',
        'puntaje',
        'calificacion',
        'fue_utilizada',
        'tiene_bonificacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'planta_permanentes_id' => 'integer',
        'fecha_desde' => 'date',
        'fecha_hasta' => 'date',
        'nivel_formulario' => 'string',
        'puntaje' => 'integer',
        'calificacion' => 'integer',
        'fue_utilizada' => 'boolean',
        'tiene_bonificacion' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'planta_permanentes_id' => 'required',
        'fecha_desde' => 'required',
        'fecha_hasta' => 'required',
        'nivel_formulario' => 'required|string|max:255',
        'puntaje' => 'required|integer',
        'calificacion' => 'required|integer',
        'fue_utilizada' => 'required|boolean',
        'tiene_bonificacion' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function plantaPermanentes()
    {
        return $this->belongsTo(\App\Models\PlantaPermanente::class, 'planta_permanentes_id');
    }
}
