<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;
use App\Http\Requests\Vaccines\StoreRequest;

class VaccinesController extends Controller
{
    public function index(){
        $vaccines = Vaccine::where('barangay_id', auth()->user()->barangay_id)->paginate(10);
        return view('Pages.Vaccines.index', compact('vaccines'));
    }

    public function create(){
        return view('Pages.Vaccines.create');
    }

    public function store(StoreRequest $request){
        $validated = $request->validated();
        $vaccine = Vaccine::where('barangay_id', auth()->user()->barangay_id)
            ->where('vaccines_name', $validated['vaccines_name'])->count();
        if($vaccine == 0){
            Vaccine::create([
                'barangay_id' => auth()->user()->barangay_id,
                'vaccines_name' => $validated['vaccines_name'],
                'brand_name' => $validated['brand_name'],
                'has_dose' => $validated['has_dose'],
            ]);
            return redirect()->route('vaccines.index')->withSuccess('Vaccines has been created');
        }
        return redirect()->route('vaccines.create')->with('error','Vaccines Name has been already taken!');
    }

    public function edit(Vaccine $vaccine){
        return view('Pages.Vaccines.edit', compact('vaccine'));
    }

    public function update(Vaccine $vaccine, StoreRequest $request){
        $validated = $request->validated();
        $vaccine->update([
            'barangay_id' => auth()->user()->barangay_id,
            'vaccines_name' => $validated['vaccines_name'],
            'has_dose' => $validated['has_dose'],
        ]);
        return redirect()->route('vaccines.index')->withSuccess('Vaccines has been updated');

    }
}
