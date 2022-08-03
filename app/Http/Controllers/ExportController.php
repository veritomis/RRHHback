<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Excel;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}




