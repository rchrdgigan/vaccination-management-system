<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildVaccines\StoreRequest;
use App\Http\Requests\ChildVaccines\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\ChildVaccine;
use App\Models\Vaccine;
use Carbon\Carbon;

class ChildVaccinesController extends Controller
{
    public function index(){
        $child_vaccines = ChildVaccine::join('children', 'children.id', '=', 'child_vaccines.child_id')
        ->select(
            'children.id as child_id',
            'children.childs_name as childs_name',
            'children.mothers_name as mothers_name',
            'children.fathers_name as fathers_name',
            'children.date_of_birth as date_of_birth',
            'children.gender as gender',
        )
        ->groupBy('children.id','children.childs_name', 'children.mothers_name', 'children.fathers_name', 'children.date_of_birth','children.gender')
        ->get();
        
        return view('Pages.ChildVaccination.index',compact('child_vaccines'));
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
                    $child_vaccines = ChildVaccine::create([
                        'child_id' => $validated['child_id'],
                        'vaccine_id' => $vaccines->id,
                        'inj_1st_date' => Carbon::now(),
                        'has_inj_1st_dose' => true,
                        'barangay_id' => auth()->user()->barangay_id,
                    ]);
                }else{
                    return redirect()->route('child-vaccines.create')->with('error','Vaccines has been already taken!');
                }
            }
        }
        return redirect()->route('child-vaccines.index')->withSuccess('Vaccines has been created');
    }

    public function edit($child_id){
        $child = Child::findOrFail($child_id);
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
        
        return view('Pages.ChildVaccination.edit',compact('child_vaccines','child'));
    }

    public function update($child_vacc_id, ChildVaccine $child_vacc, UpdateRequest $request){
         // if(count($validated['vaccine_id']) > 0){
        //     foreach($validated['vaccine_id'] as $data_id){
        //         $vaccines = Vaccine::findOrFail($data_id);
        //         if(!isset($validated['inj_1st_date'])){
        //             $validated['inj_1st_date'] = array(null);
        //         }
        //         if(!isset($validated['has_inj_1st_dose'])){
        //             $validated['has_inj_1st_dose'] = array('0');
        //         }
        //         if(!isset($validated['inj_2nd_date'])){
        //             $validated['inj_2nd_date'] = array(null);
        //         }
        //         if(!isset($validated['has_inj_2nd_dose'])){
        //             $validated['has_inj_2nd_dose'] = array('0');
        //         }
        //         if(!isset($validated['inj_3rd_date'])){
        //             $validated['inj_3rd_date'] = array(null);
        //         }
        //         if(!isset($validated['has_inj_3rd_dose'])){
        //             $validated['has_inj_3rd_dose'] = array('0');
        //         }

        //         foreach($validated['inj_1st_date'] as $inj_1st_date){
        //             foreach($validated['has_inj_1st_dose'] as $has_inj_1st_dose){
        //                 foreach($validated['inj_2nd_date'] as $inj_2nd_date){
        //                     foreach($validated['has_inj_2nd_dose'] as $has_inj_2nd_dose){
        //                         foreach($validated['inj_3rd_date'] as $inj_3rd_date){
        //                             foreach($validated['has_inj_3rd_dose'] as $has_inj_3rd_dose){
        //                                 $child_vacc = ChildVaccine::where('vaccine_id', $vaccines->id)->where('child_id', $child)
        //                                 ->update([
        //                                     'vaccine_id' =>  $vaccines->id,
        //                                     'child_id' => $child,
        //                                     'inj_1st_date' => $inj_1st_date,
        //                                     'has_inj_1st_dose' => $has_inj_1st_dose,
        //                                     'inj_2nd_date' => $inj_2nd_date,
        //                                     'has_inj_2nd_dose' => $has_inj_2nd_dose,
        //                                     'inj_3rd_date' => $inj_3rd_date,
        //                                     'has_inj_3rd_dose' => $has_inj_3rd_dose,
        //                                 ]);
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        
        $validated = $request->validated();

        if(!isset($validated['inj_1st_date'])){
            $validated['inj_1st_date'] = null;
        }
        if(!isset($validated['has_inj_1st_dose'])){
            $validated['has_inj_1st_dose'] = false;
        }
        if(!isset($validated['inj_2nd_date'])){
            $validated['inj_2nd_date'] = null;
        }
        if(!isset($validated['has_inj_2nd_dose'])){
            $validated['has_inj_2nd_dose'] = false;
        }
        if(!isset($validated['inj_3rd_date'])){
            $validated['inj_3rd_date'] = null;
        }
        if(!isset($validated['has_inj_3rd_dose'])){
            $validated['has_inj_3rd_dose'] = false;
        }
        $strArrVar = array('has_inj_1st_dose',
                            'has_inj_2nd_dose',
                            'has_inj_3rd_dose');

        $chck_vaccine_id = $child_vacc->where('id', $child_vacc_id)->first();
        $get_vacc_dose = Vaccine::where('id', $chck_vaccine_id->vaccine_id)->first();
        $set_stat = $child_vacc->where( $strArrVar[$get_vacc_dose->has_dose - 1], true)->where('id', $child_vacc_id)->get();
        ChildVaccine::where('id', $child_vacc_id)->update([
            'inj_1st_date' => $validated['inj_1st_date'],
            'has_inj_1st_dose' => $validated['has_inj_1st_dose'],
            'inj_2nd_date' => $validated['inj_2nd_date'],
            'has_inj_2nd_dose' => $validated['has_inj_2nd_dose'],
            'inj_3rd_date' => $validated['inj_3rd_date'],
            'has_inj_3rd_dose' => $validated['has_inj_3rd_dose'],
            'status' => ($set_stat->isEmpty())? 'Partial-Vaccinated' : 'Fully-Vaccinated',
        ]);
        return redirect()->route('child-vaccines.index')->withSuccess('Child Vaccines has been updated');
    }

    public function remove($id){
        $del_childvac = ChildVaccine::find($id);
        $del_childvac->delete();
        return redirect()->route('child-vaccines.index')->withSuccess(' 1 row vaccine has been removed in child vaccination');
    }

    public function destroy($id){
        $del_childvac = ChildVaccine::where('child_id',$id)->delete();
        return redirect()->route('child-vaccines.index')->withSuccess('Child Vaccination record has been deleted');
    }

}