<?php

namespace App\Http\Controllers;

use App\Imports\ChildImport;
use Illuminate\Http\Request;

class ChildImportController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $import = new ChildImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return redirect()->route('children.index')->withSuccess('Children datas has been imported!');
    }
}
