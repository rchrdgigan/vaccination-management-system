<?php

namespace App\Http\Livewire\ChildVaccines;

use App\Exports\ChildVaccinesExport as ExportsChildVaccinesExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

class ChildVaccinesExport extends Component
{
    public function export(){
        return (new ExportsChildVaccinesExport)->download('child-vaccination.xlsx');
    }

    public function render()
    {
        return view('livewire.child-vaccines.child-vaccines-export');
    }
}
