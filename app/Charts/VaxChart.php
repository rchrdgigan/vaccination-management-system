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
        $current_week_partial = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $current_week_vaccinated = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();
        $current_week_unvaccinated = Child::doesntHave('child_vaccine')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->count();

        $current_month_partial = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->count();
        $current_month_vaccinated = ChildVaccine::where('status', 'Fully-Vaccinated')
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->count();
        $current_month_unvaccinated = Child::doesntHave('child_vaccine')
                    ->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'))
                    ->count();

        $current_year_partial = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->whereYear('created_at', date('Y'))
                    ->count();
        $current_year_vaccinated = ChildVaccine::where('status', 'Partial-Vaccinated')
                    ->whereYear('created_at', date('Y'))
                    ->count();
        $current_year_unvaccinated= Child::doesntHave('child_vaccine')
                    ->whereYear('created_at', date('Y'))
                    ->count();


        return Chartisan::build()
            ->labels(['Weekly', 'Monthly', 'Yearly'])
            ->dataset('Vaccinated', [$current_week_vaccinated, $current_month_vaccinated, $current_year_vaccinated])
            ->dataset('Unvaccinated', [$current_week_unvaccinated, $current_month_unvaccinated, $current_year_unvaccinated])
            ->dataset('Partialy Vaccinated', [$current_week_partial, $current_month_partial, $current_year_partial]);
    }
}
