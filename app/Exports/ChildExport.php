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
use Maatwebsite\Excel\Concerns\WithTitle;
class ChildExport implements FromCollection, WithMapping, WithHeadings, WithEvents, ShouldAutoSize, WithTitle
{


    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Child::where('barangay_id', auth()->user()->barangay_id)->get();
    }

    public function map($child):array{
        return[
            $child->family_no,
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
        return["Family No", "Childs Name", "Mothers Name", 'Fathers Name','Birth Day', 'Place of Birth', 'Gender', 'Date of Registration', 'Birth Height', 'Birth Weight', 'Address' ];
    }
    public function registerEvents(): array{

        return[

                AfterSheet::class => function( AfterSheet $event){
                    $event->sheet->getStyle('A1:L1')->applyFromArray([
                        'font' => [
                            'bold'=>true
                        ],
                        ])
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $count = count($this->collection());
                    for($i = 1; $i<=$count; $i++){
                        $j = 1;
                        $event->sheet->getStyle('A'.$j+$i.':L'.$j+$i)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    }
                },
            ];
    }
    public function title(): string{
        return 'Children List';
    }
}
