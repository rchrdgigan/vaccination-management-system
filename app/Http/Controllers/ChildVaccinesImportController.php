<?php

namespace App\Http\Controllers;

use App\Imports\ChildVaccinesImport;
use Illuminate\Http\Request;

class ChildVaccinesImportController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $import = new ChildVaccinesImport;
        $import->import($file);
        
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return redirect()->route('child-vaccines.index')->withSuccess('Child Vaccines datas has been imported!');
    }
}
