<?php

namespace App\Http\Controllers;

use App\Exports\VaccinesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class VaccinesExportController extends Controller
{
    private $excel;
    
    public function __construct(Excel $excel){
        $this->excel = $excel;
    }
    public function export(){
        return $this->excel->download(new VaccinesExport, 'vaccines.xlsx');
    }
}
 