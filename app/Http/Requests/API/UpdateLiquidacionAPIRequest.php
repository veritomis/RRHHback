<?php

namespace App\Http\Requests\API;

use App\Models\Liquidacion;
use InfyOm\Generator\Request\APIRequest;

class UpdateLiquidacionAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Liquidacion::$rules;
        
        return $rules;
    }
}
