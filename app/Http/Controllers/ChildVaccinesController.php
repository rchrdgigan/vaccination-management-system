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
                    $child_vaccines = ChildVaccine::create([
                        'child_id' => $validated['child_id'],
                        'vaccine_id' => $vaccines->id,
                        'inj_1st_date' => now(),
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

    public function update($child_vacc_id, UpdateRequest $request){

        $validated = $request->validated();

        if(!isset($validated['has_inj_1st_dose'])){
            $validated['has_inj_1st_dose'] = false;
        }
        if(!isset($validated['has_inj_2nd_dose'])){
            $validated['has_inj_2nd_dose'] = false;
        }
        if(!isset($validated['has_inj_3rd_dose'])){
            $validated['has_inj_3rd_dose'] = false;
        }
        ChildVaccine::where('id', $child_vacc_id)->update([
            'inj_1st_date' => (isset($validated['inj_1st_date'])) ? Carbon::parse($validated['inj_1st_date'])->format('Y-m-d\TH:i') : null,
            'has_inj_1st_dose' => $validated['has_inj_1st_dose'],
            'inj_2nd_date' => (isset($validated['inj_2nd_date'])) ? Carbon::parse($validated['inj_2nd_date'])->format('Y-m-d\TH:i') : null,
            'has_inj_2nd_dose' => $validated['has_inj_2nd_dose'],
            'inj_3rd_date' => (isset($validated['inj_3rd_date'])) ? Carbon::parse($validated['inj_3rd_date'])->format('Y-m-d\TH:i') : null,
            'has_inj_3rd_dose' => $validated['has_inj_3rd_dose'],
        ]);
        $strArrVar = ['has_inj_1st_dose','has_inj_2nd_dose','has_inj_3rd_dose'];
        $chck_vaccine_id = ChildVaccine::where('id', $child_vacc_id)->first();
        $get_vacc_dose = Vaccine::where('id', $chck_vaccine_id->vaccine_id)->first();
        $set_stat = $chck_vaccine_id->where( $strArrVar[$get_vacc_dose->has_dose - 1], true)->where('id', $child_vacc_id)->get();
        $chck_vaccine_id->status = ($set_stat->isEmpty())? 'Partial-Vaccinated' : 'Fully-Vaccinated';
        $chck_vaccine_id->update();

        return redirect()->route('child-vaccines.index')->withSuccess('Child Vaccines has been updated');
    }

    public function remove($id){
        $del_childvac = ChildVaccine::find($id);
        $del_childvac->delete();
        return redirect()->route('child-vaccines.index')->withSuccess(' 1 row vaccine has been removed in child vaccination');
    }

    public function destroy(Request $request){
        $del_childvac = ChildVaccine::where('child_id',$request->child_id)->delete();
        return redirect()->route('child-vaccines.index')->withSuccess('Child Vaccination record has been deleted!');
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

    public function search(Vaccine $vaccine, $strArrVar = ['1st','2nd','3rd']){
        $dose = $_GET['has_dose'];
        $vaccines_name = $_GET['vaccines_name'];
        $vaccine = Vaccine::where('vaccines_name',$_GET['vaccines_name'])->where('barangay_id',auth()->user()->barangay_id)->first();
        if($vaccine){
            for($x = 0; $x <= $vaccine->has_dose; $x++){
                if($dose == 1){
                    $child_vacc = ChildVaccine::where('vaccine_id', $vaccine->id)->get();
                    if(!$child_vacc->isEmpty()){
                        foreach($child_vacc as $data){
                            $arry_id[] = $data->child_id;
                            $child_vaccines = Child::whereNotIn('id',$arry_id)->get();
                        }
                        return view('Pages.ChildVaccination.search',compact('vaccine','child_vaccines','dose','vaccines_name'));
                    }else{
                        return redirect()->back()->withWarning('No data input yet on that specific vaccine! Please add data atleast one before filtering...');
                    }
                }else{
                    if($_GET['date_from'] != "" && $_GET['date_to'] != ""){
                        if($dose == $x){
                            $child_vaccines = ChildVaccine::where('vaccine_id', $vaccine->id)->join('children', 'children.id', '=', 'child_vaccines.child_id')->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
                            ->select(
                                'child_vaccines.id as id',
                                'child_vaccines.child_id as child_id',
                                'children.childs_name as childs_name',
                                'children.mothers_name as mothers_name',
                                'children.fathers_name as fathers_name',
                                'children.date_of_birth as date_of_birth',
                                'vaccines.id as vaccine_id',
                                'child_vaccines.barangay_id',
                                'vaccines.vaccines_name as vaccines_name',
                                'vaccines.brand_name as brand_name',
                                'vaccines.has_dose as has_dose',
                                'child_vaccines.inj_'.$strArrVar[$x-1].'_date as inj_'.$strArrVar[$x-1].'_date',
                                'child_vaccines.has_inj_'.$strArrVar[$x-1].'_dose as has_inj_'.$strArrVar[$x-1].'_dose',
                            )
                            ->groupBy('child_vaccines.child_id','children.date_of_birth',
                            'children.fathers_name',
                            'children.mothers_name',
                            'children.childs_name',
                            'child_vaccines.barangay_id',
                            'child_vaccines.id','vaccines.id',
                            'vaccines.vaccines_name',
                            'vaccines.brand_name',
                            'vaccines.has_dose',
                            'child_vaccines.inj_'.$strArrVar[$x-1].'_date',
                            'child_vaccines.has_inj_'.$strArrVar[$x-1].'_dose')
                            ->where('child_vaccines.barangay_id', auth()->user()->barangay_id)
                            ->whereBetween('inj_'.$strArrVar[$x-1].'_date', [Carbon::parse($_GET['date_from']), Carbon::parse($_GET['date_to'])])
                            ->where('has_inj_'.$strArrVar[$x-1].'_dose', false)
                            ->get();
                            
                            return view('Pages.ChildVaccination.search',compact('vaccine','child_vaccines','dose'));
                        }
                    }else{
                        return redirect()->back()->withWarning('Please fillup date from and date to!');
                    }
                }
            }
            return redirect()->back()->withWarning('Vaccine dose must be less than or equal to '.$vaccine->has_dose.'!');
        }
        return redirect()->back()->withWarning('Vaccine does not exist! Please input valid vaccine name...');
    }

    public function injectData(StoreRequest $request){
        $validated = $request->validated();
        ChildVaccine::create([
            'child_id' => $validated['child_id'],
            'vaccine_id' => $validated['vaccine_id'],
            'inj_1st_date' => now(),
            'has_inj_1st_dose' => true,
            'barangay_id' => auth()->user()->barangay_id,
        ]);

        return redirect()->back()->withSuccess('Vaccine successfully added!');
    }

    public function viewReport(){
        $vaccines = Vaccine::get();
        if(isset($_GET['from']) && isset($_GET['to'])){
            $child_vax = ChildVaccine::whereBetween('created_at', [Carbon::parse(request('from')), Carbon::parse(request('to'))])
            ->get();
        }else{
            $child_vax = ChildVaccine::whereMonth('created_at', date('m'))
            ->get();
        }
        return view('Pages.GenerateReport.vaccine-report',compact('vaccines','child_vax'));
    }
    public function viewReportChild(Vaccine $vaccine, $strArrVar = ['1st','2nd','3rd']){
        if(isset($_GET['vaccines_name'])){
            $dose = $_GET['dose'];
            $vaccine = Vaccine::where('vaccines_name',$_GET['vaccines_name'])->where('barangay_id',auth()->user()->barangay_id)->first();
            if($vaccine){
                for($x = 0; $x <= $vaccine->has_dose; $x++){
                    if($_GET['from'] != "" && $_GET['to'] != ""){
                        if($dose == $x){
                            $child_vaccines = ChildVaccine::where('vaccine_id', $vaccine->id)->join('children', 'children.id', '=', 'child_vaccines.child_id')->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
                            ->select(
                                'child_vaccines.id as id',
                                'child_vaccines.child_id as child_id',
                                'children.childs_name as childs_name',
                                'children.mothers_name as mothers_name',
                                'children.fathers_name as fathers_name',
                                'children.date_of_birth as date_of_birth',
                                'vaccines.id as vaccine_id',
                                'child_vaccines.barangay_id',
                                'vaccines.vaccines_name as vaccines_name',
                                'vaccines.brand_name as brand_name',
                                'vaccines.has_dose as has_dose',
                                'child_vaccines.inj_'.$strArrVar[$x-1].'_date as inj_'.$strArrVar[$x-1].'_date',
                                'child_vaccines.has_inj_'.$strArrVar[$x-1].'_dose as has_inj_'.$strArrVar[$x-1].'_dose',
                            )
                            ->groupBy('child_vaccines.child_id','children.date_of_birth',
                            'children.fathers_name',
                            'children.mothers_name',
                            'children.childs_name',
                            'child_vaccines.barangay_id',
                            'child_vaccines.id','vaccines.id',
                            'vaccines.vaccines_name',
                            'vaccines.brand_name',
                            'vaccines.has_dose',
                            'child_vaccines.inj_'.$strArrVar[$x-1].'_date',
                            'child_vaccines.has_inj_'.$strArrVar[$x-1].'_dose')
                            ->where('child_vaccines.barangay_id', auth()->user()->barangay_id)
                            ->whereBetween('inj_'.$strArrVar[$x-1].'_date', [Carbon::parse($_GET['from']), Carbon::parse($_GET['to'])])
                            ->where('has_inj_'.$strArrVar[$x-1].'_dose', true)
                            ->get();

                            return view('Pages.GenerateReport.filter-child-vax',compact('vaccine','child_vaccines','dose'));
                        }
                    }else{
                        return redirect()->back()->withWarning('Please fillup date from and date to!');
                    }
                }
                return redirect()->back()->withWarning('Vaccine dose must be less than or equal to '.$vaccine->has_dose.'!');
            }
            return redirect()->back()->withWarning('Vaccine does not exist! Please input valid vaccine name...');
        }else{
            for($x = 0; $x <= 2; $x++){
                $strArrVar = ['1st','2nd','3rd'];
                $child_vaccine_dose1 = ChildVaccine::join('children', 'children.id', '=', 'child_vaccines.child_id')->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
                ->select(
                    'child_vaccines.id as id',
                    'child_vaccines.child_id as child_id',
                    'children.childs_name as childs_name',
                    'children.mothers_name as mothers_name',
                    'children.fathers_name as fathers_name',
                    'children.date_of_birth as date_of_birth',
                    'vaccines.id as vaccine_id',
                    'child_vaccines.barangay_id',
                    'vaccines.vaccines_name as vaccines_name',
                    'vaccines.brand_name as brand_name',
                    'vaccines.has_dose as has_dose',
                    'child_vaccines.inj_1st_date as inj_1st_date',
                    'child_vaccines.has_inj_1st_dose as has_inj_1st_dose',
                )
                ->groupBy('child_vaccines.child_id','children.date_of_birth',
                'children.fathers_name',
                'children.mothers_name',
                'children.childs_name',
                'child_vaccines.barangay_id',
                'child_vaccines.id','vaccines.id',
                'vaccines.vaccines_name',
                'vaccines.brand_name',
                'vaccines.has_dose',
                'child_vaccines.inj_1st_date',
                'child_vaccines.has_inj_1st_dose')
                ->where('child_vaccines.barangay_id', auth()->user()->barangay_id)
                ->where('has_inj_1st_dose', true)
                ->get();
                $child_vaccine_dose2 = ChildVaccine::join('children', 'children.id', '=', 'child_vaccines.child_id')->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
                ->select(
                    'child_vaccines.id as id',
                    'child_vaccines.child_id as child_id',
                    'children.childs_name as childs_name',
                    'children.mothers_name as mothers_name',
                    'children.fathers_name as fathers_name',
                    'children.date_of_birth as date_of_birth',
                    'vaccines.id as vaccine_id',
                    'child_vaccines.barangay_id',
                    'vaccines.vaccines_name as vaccines_name',
                    'vaccines.brand_name as brand_name',
                    'vaccines.has_dose as has_dose',
                    'child_vaccines.inj_2nd_date as inj_2nd_date',
                    'child_vaccines.has_inj_2nd_dose as has_inj_2nd_dose',
                )
                ->groupBy('child_vaccines.child_id','children.date_of_birth',
                'children.fathers_name',
                'children.mothers_name',
                'children.childs_name',
                'child_vaccines.barangay_id',
                'child_vaccines.id','vaccines.id',
                'vaccines.vaccines_name',
                'vaccines.brand_name',
                'vaccines.has_dose',
                'child_vaccines.inj_2nd_date',
                'child_vaccines.has_inj_2nd_dose')
                ->where('child_vaccines.barangay_id', auth()->user()->barangay_id)
                ->where('has_inj_2nd_dose', true)
                ->get();
                $child_vaccine_dose3 = ChildVaccine::join('children', 'children.id', '=', 'child_vaccines.child_id')->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
                ->select(
                    'child_vaccines.id as id',
                    'child_vaccines.child_id as child_id',
                    'children.childs_name as childs_name',
                    'children.mothers_name as mothers_name',
                    'children.fathers_name as fathers_name',
                    'children.date_of_birth as date_of_birth',
                    'vaccines.id as vaccine_id',
                    'child_vaccines.barangay_id',
                    'vaccines.vaccines_name as vaccines_name',
                    'vaccines.brand_name as brand_name',
                    'vaccines.has_dose as has_dose',
                    'child_vaccines.inj_3rd_date as inj_3rd_date',
                    'child_vaccines.has_inj_3rd_dose as has_inj_3rd_dose',
                )
                ->groupBy('child_vaccines.child_id','children.date_of_birth',
                'children.fathers_name',
                'children.mothers_name',
                'children.childs_name',
                'child_vaccines.barangay_id',
                'child_vaccines.id','vaccines.id',
                'vaccines.vaccines_name',
                'vaccines.brand_name',
                'vaccines.has_dose',
                'child_vaccines.inj_3rd_date',
                'child_vaccines.has_inj_3rd_dose')
                ->where('child_vaccines.barangay_id', auth()->user()->barangay_id)
                ->where('has_inj_3rd_dose', true)
                ->get();
            }

            $child_vaccines = array($child_vaccine_dose1, $child_vaccine_dose2, $child_vaccine_dose3);
            
            return view('Pages.GenerateReport.child-vaccine-report',compact('vaccine','child_vaccines'));

        }
    }
}
