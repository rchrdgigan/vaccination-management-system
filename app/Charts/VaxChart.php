<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Child;
use App\Models\ChildVaccine;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class VaxChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $total_week_partial_1dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                    ->whereBetween('inj_1st_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $total_week_partial_2dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                    ->whereBetween('inj_2nd_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $total_week_partial_3dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                    ->whereBetween('inj_3rd_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $current_week_partial = $total_week_partial_1dose + $total_week_partial_2dose + $total_week_partial_3dose;

        $total_week_vaccinated_1dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                    ->whereBetween('inj_1st_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $total_week_vaccinated_2dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                    ->whereBetween('inj_2nd_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $total_week_vaccinated_3dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                    ->whereBetween('inj_3rd_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $current_week_vaccinated = $total_week_vaccinated_1dose + $total_week_vaccinated_2dose + $total_week_vaccinated_3dose;

        $current_week_unvaccinated = Child::doesntHave('child_vaccine')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        
        $total_month_partial_1dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                    ->whereMonth('inj_1st_date', date('m'))
                    ->whereYear('inj_1st_date', date('Y'))
                    ->count();
        $total_month_partial_2dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                    ->whereMonth('inj_2nd_date', date('m'))
                    ->whereYear('inj_2nd_date', date('Y'))
                    ->count();
        $total_month_partial_3dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                    ->whereMonth('inj_3rd_date', date('m'))
                    ->whereYear('inj_3rd_date', date('Y'))
                    ->count();
        $current_month_partial = $total_month_partial_1dose + $total_month_partial_2dose + $total_month_partial_3dose;

        $total_month_vaccinated_1dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                    ->whereMonth('inj_1st_date', date('m'))
                    ->whereYear('inj_1st_date', date('Y'))
                    ->count();
        $total_month_vaccinated_2dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                    ->whereMonth('inj_2nd_date', date('m'))
                    ->whereYear('inj_2nd_date', date('Y'))
                    ->count();
        $total_month_vaccinated_3dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                    ->whereMonth('inj_3rd_date', date('m'))
                    ->whereYear('inj_3rd_date', date('Y'))
                    ->count();
        $current_month_vaccinated = $total_month_vaccinated_1dose + $total_month_vaccinated_2dose + $total_month_vaccinated_3dose;

        $current_month_unvaccinated = Child::doesntHave('child_vaccine')
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->count();

        $total_year_partial_1dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                    ->whereYear('inj_1st_date', date('Y'))
                    ->count();
        $total_year_partial_2dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                    ->whereYear('inj_2nd_date', date('Y'))
                    ->count();
        $total_year_partial_3dose = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                    ->whereYear('inj_3rd_date', date('Y'))
                    ->count();
        $current_year_partial = $total_year_partial_1dose + $total_year_partial_2dose + $total_year_partial_3dose;

        $total_year_vaccinated_1dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_1st_dose', true)
                    ->whereYear('inj_1st_date', date('Y'))
                    ->count();
        $total_year_vaccinated_2dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_2nd_dose', true)
                    ->whereYear('inj_2nd_date', date('Y'))
                    ->count();
        $total_year_vaccinated_3dose = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->where('barangay_id', auth()->user()->barangay_id)->where('has_inj_3rd_dose', true)
                    ->whereYear('inj_3rd_date', date('Y'))
                    ->count();
        $current_year_vaccinated = $total_year_vaccinated_1dose + $total_year_vaccinated_2dose + $total_year_vaccinated_3dose;

        $current_year_unvaccinated= Child::doesntHave('child_vaccine')
                    ->whereYear('created_at', date('Y'))
                    ->count();


        return Chartisan::build()
            ->labels(['Weekly', 'Monthly', 'Yearly'])
            ->dataset('Vaccinated', [$current_week_vaccinated, $current_month_vaccinated, $current_year_vaccinated])
            ->dataset('Unvaccinated', [$current_week_unvaccinated, $current_month_unvaccinated, $current_year_unvaccinated])
            ->dataset('Partialy Vaccinated', [$total_week_partial_1dose, $current_month_partial, $current_year_partial]);
    }
}
