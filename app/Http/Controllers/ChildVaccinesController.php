<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildVaccines\StoreRequest;
use App\Http\Requests\ChildVaccines\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\ChildVaccine;
use App\Models\DoseInject;
use App\Models\Vaccine;
use Carbon\Carbon;

class ChildVaccinesController extends Controller
{
    public function index(Vaccine $vaccine){
        
        $child_vaccines = ChildVaccine::join('children', 'children.id', '=', 'child_vaccines.child_id')
        ->select(
            'children.id as child_id',
            'children.childs_name as childs_name',
            'children.mothers_name as mothers_name',
            'children.fathers_name as fathers_name',
            'children.date_of_birth as date_of_birth',
            'children.gender as gender',
            'child_vaccines.barangay_id'
        )
        ->groupBy('child_vaccines.barangay_id','children.id','children.childs_name', 'children.mothers_name', 'children.fathers_name', 'children.date_of_birth','children.gender')
        ->where('child_vaccines.barangay_id',auth()->user()->barangay_id)->where('childs_name', 'LIKE', '%'.request('search').'%')->get();
        
        return view('Pages.ChildVaccination.index',compact('child_vaccines','vaccine'));
    }

    public function create(){
        $child = Child::where('barangay_id', auth()->user()->barangay_id)->get();
        $vaccine = Vaccine::where('barangay_id', auth()->user()->barangay_id)->get();
        return view('Pages.ChildVaccination.create',compact('child','vaccine'));
    }

    public function store(StoreRequest $request){
        $validated = $request->validated();
        if(count($validated['vaccine_id']) > 0){
            foreach($validated['vaccine_id'] as $data_id){
                $vaccine = ChildVaccine::where('child_id', $validated['child_id'])
                ->where('vaccine_id', $data_id)->count();
                if($vaccine == 0){
                    $vaccines = Vaccine::findOrFail($data_id);
                    $child_vacc = ChildVaccine::create([
                        'child_id' => $validated['child_id'],
                        'vaccine_id' => $vaccines->id,
                        'barangay_id' => auth()->user()->barangay_id,
                    ]);
                    $child_vacc->dose_inject()->create([
                        'barangay_id' => auth()->user()->barangay_id,
                        'dose' => 1,
                        'has_inj' => true,
                        'inj_date' => now(),
                        'reason' => null,
                    ]);
                }else{
                    return redirect()->route('child-vaccines.create')->with('error','Vaccines has been already taken!');
                }
            }
        }
        return redirect()->route('child-vaccines.index')->withSuccess('Vaccines has been created');
    }

    public function edit($id){
        $child = Child::findOrFail($id);

        if(!isset($_GET['vaccine_id'])){
            $child_vaccines = ChildVaccine::where('child_id', $child->id)->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
            ->select(
                'child_vaccines.id as id',
                'vaccines.id as vaccine_id',
                'vaccines.vaccines_name as vaccines_name',
                'vaccines.brand_name as brand_name',
                'vaccines.has_dose as has_dose',
                'child_vaccines.inj_1st_date as inj_1st_date',
                'child_vaccines.has_inj_1st_dose as has_inj_1st_dose',
                'child_vaccines.inj_2nd_date as inj_2nd_date',
                'child_vaccines.has_inj_2nd_dose as has_inj_2nd_dose',
                'child_vaccines.inj_3rd_date as inj_3rd_date',
                'child_vaccines.has_inj_3rd_dose as has_inj_3rd_dose',
            )
            ->groupBy('child_vaccines.id','vaccines.id','vaccines.vaccines_name','vaccines.brand_name','vaccines.has_dose','child_vaccines.inj_1st_date','child_vaccines.has_inj_1st_dose','child_vaccines.inj_2nd_date','child_vaccines.has_inj_2nd_dose','child_vaccines.inj_3rd_date','child_vaccines.has_inj_3rd_dose')
            ->get();
        } else {
            $child_vaccines = ChildVaccine::where('child_id', $child->id)->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')->where('vaccine_id', $_GET['vaccine_id'])
            ->select(
                'child_vaccines.id as id',
                'vaccines.id as vaccine_id',
                'vaccines.vaccines_name as vaccines_name',
                'vaccines.brand_name as brand_name',
                'vaccines.has_dose as has_dose',
                'child_vaccines.inj_1st_date as inj_1st_date',
                'child_vaccines.has_inj_1st_dose as has_inj_1st_dose',
                'child_vaccines.inj_2nd_date as inj_2nd_date',
                'child_vaccines.has_inj_2nd_dose as has_inj_2nd_dose',
                'child_vaccines.inj_3rd_date as inj_3rd_date',
                'child_vaccines.has_inj_3rd_dose as has_inj_3rd_dose',
            )
            ->groupBy('child_vaccines.id','vaccines.id','vaccines.vaccines_name','vaccines.brand_name','vaccines.has_dose','child_vaccines.inj_1st_date','child_vaccines.has_inj_1st_dose','child_vaccines.inj_2nd_date','child_vaccines.has_inj_2nd_dose','child_vaccines.inj_3rd_date','child_vaccines.has_inj_3rd_dose')
            ->get();
        }
        
        return view('Pages.ChildVaccination.edit',compact('child_vaccines','child'));
    }

    public function addVaccineDose($id, Request $request){

        if(!isset($validated['inj_date'])){
            $validated['inj_date'] = null;
        }
        if(!isset($validated['dose'])){
            $validated['dose'] = false;
        }
        if( $request->has_inj == null){
            $request->has_inj = 0;
        }
        $get_vacc = Vaccine::where('id', $request->vaccine_id)->first();
        $child_vacc = ChildVaccine::where('child_id',$id)->where('vaccine_id', $get_vacc->id)->where('barangay_id', auth()->user()->barangay_id)->first();
        $check_recent_inj = DoseInject::where('child_vaccine_id',$child_vacc->id)->where('dose',$request->dose-1)->first();
        if($check_recent_inj->has_inj == true){
            $child_vacc->dose_inject()->create([
                'barangay_id' => auth()->user()->barangay_id,
                'dose' => $request->dose,
                'has_inj' => $request->has_inj,
                'inj_date' => Carbon::parse($validated['inj_date'])->format('Y-m-d\TH:i'),
                'status' => $request->status,
                'reason' => $request->reason,
            ]);
            $check_has_inj = DoseInject::where('child_vaccine_id',$child_vacc->id)->where('dose',$get_vacc->has_dose)->first();
            if($check_has_inj != null){
                if($check_has_inj->has_inj == true){
                    $child_vacc->status = 'Fully-Vaccinated';
                    $child_vacc->update();
                }
            }
            return redirect()->back()->with('message','Dose of Vaccines has been added');

        }else{
            return redirect()->back()->with('message','No row added. Please check the recent dose if injected.');
        }

    }

    public function update($child_id, UpdateRequest $request){
        
        $validated = $request->validated();
        if(!isset($validated['inj_date'])){
            $validated['inj_date'] = null;
        }
        if(!isset($validated['has_inj'])){
            $validated['has_inj'] = 0;
        }
        $vacc_dose = DoseInject::findOrFail($validated['vacc_dose_id']);
        $vacc_dose->update([
            'barangay_id' => auth()->user()->barangay_id,
            'has_inj' => $validated['has_inj'],
            'inj_date' => Carbon::parse($validated['inj_date'])->format('Y-m-d\TH:i'),
            'status' => $validated['status'],
            'reason' => $validated['reason'],
        ]);

        $get_vacc = Vaccine::where('id', $request->vaccine_id)->first();
        $child_vacc = ChildVaccine::where('child_id',$child_id)->where('vaccine_id', $get_vacc->id)->where('barangay_id', auth()->user()->barangay_id)->first();
        $check_has_inj = DoseInject::where('child_vaccine_id', $child_vacc->id)->where('dose', $get_vacc->has_dose)->first();
        if($check_has_inj != null){
            if($check_has_inj->has_inj == true){
                $child_vacc->status = 'Fully-Vaccinated';
                $child_vacc->update();
            }else{
                $child_vacc->status = 'Partial-Vaccinated';
                $child_vacc->update();
            }
        }
        return redirect()->back()->with('message','Dose of Vaccines has been update');
    }

    public function remove($id){
        $del_childvac = ChildVaccine::find($id);
        $del_childvac->delete();
        return redirect()->route('child-vaccines.index')->withSuccess(' 1 row vaccine has been removed in child vaccination');
    }

    public function destroy($id){
        $del_childvac = ChildVaccine::findOrFail($id);
        $del_childvac->delete();
        return redirect()->route('child-vaccines.index')->withSuccess('Child Vaccination record has been deleted');
    }

    public function show($id){
        $child = Child::findOrFail($id);
        $child_vaccines = ChildVaccine::where('child_id', $child->id)->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
        ->select(
            'child_vaccines.id as id',
            'vaccines.id as vaccine_id',
            'vaccines.vaccines_name as vaccines_name',
            'vaccines.brand_name as brand_name',
            'vaccines.has_dose as has_dose',
            'child_vaccines.inj_1st_date as inj_1st_date',
            'child_vaccines.has_inj_1st_dose as has_inj_1st_dose',
            'child_vaccines.inj_2nd_date as inj_2nd_date',
            'child_vaccines.has_inj_2nd_dose as has_inj_2nd_dose',
            'child_vaccines.inj_3rd_date as inj_3rd_date',
            'child_vaccines.has_inj_3rd_dose as has_inj_3rd_dose',
        )
        ->groupBy('child_vaccines.id','vaccines.id','vaccines.vaccines_name','vaccines.brand_name','vaccines.has_dose','child_vaccines.inj_1st_date','child_vaccines.has_inj_1st_dose','child_vaccines.inj_2nd_date','child_vaccines.has_inj_2nd_dose','child_vaccines.inj_3rd_date','child_vaccines.has_inj_3rd_dose')
        ->get();
        
        return view('Pages.ChildVaccination.show',compact('child_vaccines', 'child'));
    }

    public function getChildVaccineAvailable($id){
        $child = Child::where('id', $id)->get();
        $childvac = ChildVaccine::where('child_id',$id)->get();
        foreach($childvac as $data){
            $arry_id[] = $data->vaccine_id;
            $vaccine = Vaccine::whereNotIn('id',$arry_id)->get();
        }
        return view('Pages.ChildVaccination.create',compact('child','vaccine'));

    }
}