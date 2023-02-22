<?php

namespace App\Repositories;

use App\Models\Documento;
use App\Repositories\BaseRepository;

/**
 * Class DocumentoRepository
 * @package App\Repositories
 * @version October 20, 2022, 12:13 am -03
*/

class DocumentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Documento::class;
    }
}
