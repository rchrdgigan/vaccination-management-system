<?php

namespace App\Http\Livewire\Children;

use App\Exports\ChildExport as ExportsChildExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ChildExport extends Component
{

    public function export(){
        return (new ExportsChildExport)->download("Children-data.xlsx");

    }
    public function render()
    {
        return view('livewire.children.child-export');
    }
}
