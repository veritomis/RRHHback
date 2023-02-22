<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="AsistenciaMedica",
 *      required={"agente_id", "historia_clinica", "tipo_licencia", "diagnostico", "tratamiento", "estudio_complementario", "imagen_url"},
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
 *          property="historia_clinica",
 *          description="historia_clinica",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="tipo_licencia",
 *          description="tipo_licencia",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="diagnostico",
 *          description="diagnostico",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="tratamiento",
 *          description="tratamiento",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="estudio_complementario",
 *          description="estudio_complementario",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="numero_nota_realizada",
 *          description="numero_nota_realizada",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="imagen_url",
 *          description="imagen_url",
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
class AsistenciaMedica extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'asistencia_medicas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'agente_id',
        'historia_clinica',
        'tipo_licencia',
        'diagnostico',
        'tratamiento',
        'estudio_complementario',
        'numero_nota_realizada',
        'imagen_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'agente_id' => 'integer',
        'historia_clinica' => 'string',
        'tipo_licencia' => 'string',
        'diagnostico' => 'string',
        'tratamiento' => 'string',
        'estudio_complementario' => 'string',
        'numero_nota_realizada' => 'string',
        'imagen_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'agente_id' => 'required',
        'historia_clinica' => 'required|string|max:255',
        'tipo_licencia' => 'required|string|max:255',
        'diagnostico' => 'required|string|max:255',
        'tratamiento' => 'required|string|max:255',
        'estudio_complementario' => 'required|string|max:255',
        'numero_nota_realizada' => 'nullable|string|max:255',
        // 'imagen_url' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function agente()
    {
        return $this->belongsTo(\App\Models\Agente::class, 'agente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     **/
    public function documentos()
    {
        return $this->morphMany(Documento::class, 'modelogable');
    }
}
