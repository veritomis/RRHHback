<?php

namespace App\Exports;

use App\Models\Agente;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agente::all();
    }
}
