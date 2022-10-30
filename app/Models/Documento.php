<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Documento",
 *      required={"archivo", "url", "ext", "orden", "modelogable_type", "modelogable_id"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="archivo",
 *          description="archivo",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="url",
 *          description="url",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="ext",
 *          description="ext",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="orden",
 *          description="orden",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="modelogable_type",
 *          description="modelogable_type",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="modelogable_id",
 *          description="modelogable_id",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="fecha_de_carga",
 *          description="fecha_de_carga",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="fecha_de_emision",
 *          description="fecha_de_emision",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="fecha_de_vencimiento",
 *          description="fecha_de_vencimiento",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="fecha_de_cotejo",
 *          description="fecha_de_cotejo",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
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
class Documento extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'documentos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'archivo',
        'url',
        'ext',
        'orden',
        'modelogable_type',
        'modelogable_id',
        'fecha_de_carga',
        'fecha_de_emision',
        'fecha_de_vencimiento',
        'fecha_de_cotejo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'archivo' => 'string',
        'url' => 'string',
        'ext' => 'string',
        'orden' => 'integer',
        'modelogable_type' => 'string',
        'modelogable_id' => 'integer',
        'fecha_de_carga' => 'date',
        'fecha_de_emision' => 'date',
        'fecha_de_vencimiento' => 'date',
        'fecha_de_cotejo' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'archivo' => 'required|string|max:255',
        'url' => 'required|string|max:255',
        'ext' => 'required|string|max:255',
        'orden' => 'required|integer',
        'modelogable_type' => 'required|string|max:255',
        'modelogable_id' => 'required',
        'fecha_de_carga' => 'nullable',
        'fecha_de_emision' => 'nullable',
        'fecha_de_vencimiento' => 'nullable',
        'fecha_de_cotejo' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function modelogable()
    {
        return $this->morphTo();
    }
}
