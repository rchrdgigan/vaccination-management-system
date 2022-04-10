<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\VaccinesImport;

class VaccinesImportController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $import = new VaccinesImport;
        $import->import($file);
        
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return redirect()->route('vaccines.index')->withSuccess('Vaccines datas has been imported!');
    }
}
