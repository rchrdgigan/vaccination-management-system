<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ChildExport implements FromCollection, WithMapping, WithHeadings, WithEvents, ShouldAutoSize
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Child::all();
    }

    public function map($child):array{
        return[
            $child->id,
            $child->childs_name,
            $child->mothers_name,
            $child->fathers_name,
            $child->date_of_birth,
            $child->place_of_birth,
            $child->gender,
            $child->date_of_registration,
            $child->birth_height,
            $child->birth_weight,
            $child->address,
        ];
    }

    public function headings():array{
        return["id", "Childs Name", "Mothers Name", 'Fathers Name','Birth Day', 'Place of Birth', 'Gender', 'Date of Registration', 'Birth Height', 'Birth Weight', 'Address' ];
    }

    public function registerEvents(): array{
        return[
                AfterSheet::class => function( AfterSheet $event){
                    $event->sheet->getStyle('A1:K1')->applyFromArray([
                        'font' => [
                            'bold'=>true
                        ],
                        ]);
                }
            ];

    }
}
