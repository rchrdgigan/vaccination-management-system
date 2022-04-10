<?php

namespace App\Exports;

use App\Models\Vaccine;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class VaccinesExport implements 
    FromCollection, 
    ShouldAutoSize, 
    WithMapping,
    WithHeadings,
    WithEvents
{
    use Exportable;
 
    public function collection(){
        return Vaccine::all();
    }

    public function map($vaccine): array {
        return [
            $vaccine->vaccines_name,
            $vaccine->brand_name,
            $vaccine->has_dose,
            $vaccine->created_at,
        ];
    }

    public function headings(): array {
        return [
            'Name of Vaccine',
            'Brand of Vaccine',
            'Vaccine Dose',
            'Created At',
        ];
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}