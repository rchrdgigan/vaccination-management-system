<?php

namespace App\Exports;

use App\Models\ChildVaccine;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class ChildVaccinesExport implements
    FromCollection, 
    ShouldAutoSize, 
    WithMapping,
    WithHeadings,
    WithEvents
{
    use Exportable;

    public function collection()
    {
        return ChildVaccine::join('children', 'children.id', '=', 'child_vaccines.child_id')
        ->join('vaccines', 'vaccines.id', '=', 'child_vaccines.vaccine_id')
        ->select(
            'children.childs_name as childs_name',
            'children.date_of_birth as date_of_birth',
            'vaccines.vaccines_name as vaccines_name',
            'vaccines.has_dose as has_dose',
            'child_vaccines.has_inj_1st_dose as has_inj_1st_dose',
            'child_vaccines.has_inj_2nd_dose as has_inj_2nd_dose',
            'child_vaccines.has_inj_3rd_dose as has_inj_3rd_dose',
            'child_vaccines.inj_1st_date as inj_1st_date',
            'child_vaccines.inj_2nd_date as inj_2nd_date',
            'child_vaccines.inj_3rd_date as inj_3rd_date',
            'child_vaccines.status as status',
            'child_vaccines.barangay_id'
        )
        ->groupBy('child_vaccines.barangay_id','children.childs_name','children.date_of_birth','vaccines.vaccines_name','vaccines.has_dose','child_vaccines.inj_1st_date','child_vaccines.has_inj_1st_dose','child_vaccines.inj_2nd_date','child_vaccines.has_inj_2nd_dose','child_vaccines.inj_3rd_date','child_vaccines.has_inj_3rd_dose','child_vaccines.status')
        ->where('child_vaccines.barangay_id',auth()->user()->barangay_id)->get();
    }

    public function map($child_vaccine): array {
        return [
            $child_vaccine->childs_name,
            $child_vaccine->date_of_birth,
            $child_vaccine->vaccines_name,
            $child_vaccine->has_dose,
            $child_vaccine->has_inj_1st_dose,
            $child_vaccine->has_inj_2nd_dose,
            $child_vaccine->has_inj_3rd_dose,
            $child_vaccine->inj_1st_date,
            $child_vaccine->inj_2nd_date,
            $child_vaccine->inj_3rd_date,
            $child_vaccine->status,
        ];
    }
    
    public function headings(): array {
        return [
            'Child Name',
            'Date of Birth',
            'Vaccine',
            'Dose',
            '1st Dose',
            '2nd Dose',
            '3rd Dose',
            '1st Injected Date',
            '2nd Injected Date',
            '3rd Injected Date',
            'Status',
        ];
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
