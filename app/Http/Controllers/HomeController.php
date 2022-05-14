<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\User;
use App\Models\ChildVaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $registered_midwife = User::where('barangay_id',auth()->user()->barangay_id)->count();

        $total_1dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                ->count();
        $total_2dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                ->count();
        $total_3dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                ->count();
        $fully_vaccinated = $total_1dose + $total_2dose + $total_3dose;

        $total_partial_1dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                ->count();
        $total_partial_2dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                ->count();
        $total_partial_3dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                ->count();
        $partial_vaccinated = $total_partial_1dose + $total_partial_2dose + $total_partial_3dose;

        $registered_child = Child::where('barangay_id',auth()->user()->barangay_id)->count();

        return view('welcome',compact('registered_midwife','fully_vaccinated','partial_vaccinated','registered_child'));
    }
}
