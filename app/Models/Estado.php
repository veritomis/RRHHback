<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Estado
 * @package App\Models
 * @version April 28, 2022, 4:23 am UTC
 *
 * @property string $nombre
 * @property string $siglas
 * @property string $capital
 * @property integer $poblacion
 */
class Estado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'estados';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'siglas',
        'capital',
        'poblacion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'siglas' => 'string',
        'capital' => 'string',
        'poblacion' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:45',
        'siglas' => 'required|string|max:2',
        'capital' => 'required|string|max:45',
        'poblacion' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
