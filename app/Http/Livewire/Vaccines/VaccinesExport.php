<?php

namespace App\Http\Livewire\Vaccines;

use App\Exports\VaccinesExport as ExportsVaccineExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

class VaccinesExport extends Component
{
    public function export(){
        return (new ExportsVaccineExport)->download('vaccines.xlsx');
    }

    public function render()
    {
        return view('livewire.vaccines.vaccines-export');
    }
}
