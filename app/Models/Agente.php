<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

/**
 * @OA\Schema(
 *      schema="Agente",
 *      required={"segundo_nombre", "segundo_apellido", "grupo_id"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=true,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="primer_nombre",
 *          description="primer_nombre",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="segundo_nombre",
 *          description="segundo_nombre",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="primer_apellido",
 *          description="primer_apellido",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="segundo_apellido",
 *          description="segundo_apellido",
 *          readOnly=false,
 *          nullable=false,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="dni",
 *          description="dni",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="cuil",
 *          description="cuil",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="fecha_nacimiento",
 *          description="fecha_nacimiento",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date"
 *      ),
 *      @OA\Property(
 *          property="genero",
 *          description="genero",
 *          readOnly=false,
 *          nullable=true,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="fecha_ingreso_ministerio",
 *          description="fecha_ingreso_ministerio",
 *          readOnly=false,
 *          nullable=true,
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
 *          property="grupo_id",
 *          description="grupo_id",
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
class Agente extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'agentes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'dni',
        'cuil',
        'fecha_nacimiento',
        'genero',
        'fecha_ingreso_ministerio',
        'letra_nivel',
        'numero_grado',
        'grupo_id',
        'estado_civil',
        'domi',
        'cpos',
        'loc_id',
        'loc_descripcion',
        'prov_id',
        'prv_descripcion',
        'telefono',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'primer_apellido' => 'string',
        'segundo_apellido' => 'string',
        'dni' => 'string',
        'cuil' => 'string',
        'fecha_nacimiento' => 'date',
        'genero' => 'string',
        'fecha_ingreso_ministerio' => 'date',
        'letra_nivel' => 'string',
        'numero_grado' => 'string',
        'grupo_id' => 'integer',
        'estado_civil'=> 'string',
        'domi'=> 'string',
        'cpos'=> 'string',
        'loc_id'=> 'string',
        'loc_descripcion'=> 'string',
        'prov_id'=> 'string',
        'prv_descripcion'=> 'string',
        'telefono'=> 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'primer_nombre' => 'nullable|string|max:255',
        // 'segundo_nombre' => 'required|string|max:255',
        'primer_apellido' => 'nullable|string|max:255',
        // 'segundo_apellido' => 'required|string|max:255',
        'dni' => 'nullable|string|max:255',
        'cuil' => 'nullable|string|max:255',
        'fecha_nacimiento' => 'nullable',
        // 'genero' => 'required|string|max:255',
        // 'fecha_ingreso_ministerio' => 'required',
        'letra_nivel' => 'nullable|string|max:255',
        'numero_grado' => 'nullable|string|max:255',
        // 'grupo_id' => 'required',
        'estado_civil'=> 'nullable|string|max:255',
        'domi'=> 'nullable|string|max:255',
        'cpos'=> 'nullable|string|max:255',
        'loc_id'=> 'nullable|string|max:255',
        'loc_descripcion'=> 'nullable|string|max:255',
        'prov_id'=> 'nullable|string|max:255',
        'prv_descripcion'=> 'nullable|string|max:255',
        'telefono'=> 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function grupo()
    {
        return $this->belongsTo(\App\Models\Grupo::class, 'grupo_id');
    }

    public function contratos()
    {
        return $this->hasMany(\App\Models\Contrato::class, 'agente_id');
    }
    public function asistenciaMedicas()
    {
        return $this->hasMany(\App\Models\AsistenciaMedica::class, 'agente_id');
    }

    public function legajos()
    {
        return $this->hasMany(\App\Models\Legajo::class, 'agente_id');
    }

    public function liquidaciones()
    {
        return $this->hasMany(\App\Models\Liquidacion::class, 'agente_id');
    }

    public function carreras()
    {
        return $this->hasOne(\App\Models\Carrera::class, 'agente_id');
    }

    public function asistencias()
    {
        return $this->hasMany(\App\Models\Asistencia::class, 'agente_id');
    }

    public function plantaPermanente()
    {
        return $this->hasOne(\App\Models\PlantaPermanente::class, 'agente_id');
    }

    /**
     * Scope to search by any column
     * @param  Builder $query
     * @param  string $filter
     * @return Builder
     */
    public function scopeQuery(Builder $query, $filter)
    {
        $value = "%$filter%";

        return $query->where('dni', 'LIKE', $value)
            ->orWhere('primer_nombre', 'LIKE', $value)
            ->orWhere('primer_apellido', 'LIKE', $value)
            ->orWhere('segundo_apellido', 'LIKE', $value);;

    }

}
