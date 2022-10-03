<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Capacitacion",
 *      required={"apto_tramo", "corrimiento_grado", "fue_utilizada", "carrera_id"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="apto_tramo",
 *          description="apto_tramo",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="corrimiento_grado",
 *          description="corrimiento_grado",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="fue_utilizada",
 *          description="fue_utilizada",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="tramo",
 *          description="tramo",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="nivel",
 *          description="nivel",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="agrupamiento",
 *          description="agrupamiento",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="perfiles",
 *          description="perfiles",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="saldo",
 *          description="saldo",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="carrera_id",
 *          description="carrera_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
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
 *      )
 * )
 */
class Capacitacion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'capacitaciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'apto_tramo',
        'corrimiento_grado',
        'fue_utilizada',
        'tramo',
        'nivel',
        'agrupamiento',
        'perfiles',
        'saldo',
        'carrera_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'apto_tramo' => 'boolean',
        'corrimiento_grado' => 'boolean',
        'fue_utilizada' => 'boolean',
        'tramo' => 'string',
        'nivel' => 'string',
        'agrupamiento' => 'string',
        'perfiles' => 'string',
        'saldo' => 'string',
        'carrera_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'apto_tramo' => 'required|boolean',
        'corrimiento_grado' => 'required|boolean',
        'fue_utilizada' => 'required|boolean',
        'tramo' => 'nullable|string|max:255',
        'nivel' => 'nullable|string|max:255',
        'agrupamiento' => 'nullable|string|max:255',
        'perfiles' => 'nullable|string|max:255',
        'saldo' => 'nullable|string|max:255',
        'carrera_id' => 'required',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function carrera()
    {
        return $this->belongsTo(\App\Models\Carrera::class, 'carrera_id');
    }
}
