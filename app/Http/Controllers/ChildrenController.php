<?php

namespace App\Http\Controllers;

use App\Http\Requests\Children\StoreRequest;
use App\Models\Barangay;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index(){
        $childrens = Child::search(request('search'))->where('barangay_id', auth()->user()->barangay_id)->paginate(10);
        $count = count($childrens);

        return view('Pages.Children.index', compact('childrens','count'));
    }

    public function create(){
        return view('Pages.Children.create');
    }

    public function store(StoreRequest $request){
        $validated = $request->validated();
        $reg_date = Carbon::parse($validated['reg_date']);
        $birth_date = Carbon::parse($validated['birth_date']);
        Child::create([
            'family_no' => $validated['family_no'],
            'childs_name' => $validated['child_name'],
            'date_of_registration' => $reg_date,
            'date_of_birth' => $birth_date,
            'place_of_birth' => $validated['birth_place'],
            'gender' => $validated['gender'],
            'mothers_name' => $validated['mother_name'],
            'fathers_name' => $validated['father_name'],
            'address' => $validated['address'],

            'birth_height' => $validated['height'],
            'birth_weight' => $validated['weight'],
            'barangay_id' => auth()->user()->barangay_id,
        ]);
        return redirect()->route('children.index')->withSuccess('Children has been created');
    }

    public function edit(Child $child){
        return view('Pages.Children.edit', compact('child'));
    }

    public function update(Child $child, StoreRequest $request){
        $validated = $request->validated();
        $reg_date = Carbon::parse($validated['reg_date']);
        $birth_date = Carbon::parse($validated['birth_date']);
        $child->update([
            'family_no' => $validated['family_no'],
            'childs_name' => $validated['child_name'],
            'date_of_registration' => $reg_date,
            'date_of_birth' => $birth_date,
            'place_of_birth' => $validated['birth_place'],
            'gender' => $validated['gender'],
            'mothers_name' => $validated['mother_name'],
            'fathers_name' => $validated['father_name'],
            'birth_height' => $validated['height'],
            'birth_weight' => $validated['weight'],
            'address' => $validated['address'],
            'barangay_id' => auth()->user()->barangay_id,
        ]);
        return redirect()->route('children.index')->withSuccess('Children has been updated');
    }
}
