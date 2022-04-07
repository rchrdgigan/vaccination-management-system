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
        $childrens = Child::paginate(10);
        return view('Pages.Children.index', compact('childrens'));
    }

    public function create(){
        $barangays = Barangay::get();
        return view('Pages.Children.create', compact('barangays'));
    }

    public function store(StoreRequest $request){
        $validated = $request->validated();
        $reg_date = Carbon::parse($validated['reg_date']);
        $birth_date = Carbon::parse($validated['birth_date']);
        Child::create([
            'childs_name' => $validated['child_name'],
            'date_of_registration' => $reg_date,
            'date_of_birth' => $birth_date,
            'place_of_birth' => $validated['birth_place'],
            'gender' => $validated['gender'],
            'mothers_name' => $validated['mother_name'],
            'fathers_name' => $validated['father_name'],
            'birth_height' => $validated['height'],
            'birth_weight' => $validated['weight'],
            'barangay_id' => $validated['brgy_id'],
        ]);
        return redirect()->route('children.index')->withSuccess('Children has been created');
    }
}
