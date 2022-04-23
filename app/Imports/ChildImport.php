<?php

namespace App\Imports;

use App\Models\Child;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use DateTime;

class ChildImport implements
ToCollection,
WithHeadingRow,
SkipsOnError,
SkipsOnFailure,
WithChunkReading,
ShouldQueue,
WithEvents
{

    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $children = Child::where('barangay_id', auth()->user()->barangay_id)
            ->where('childs_name', $row['childs_name'])->count();
            if($children == 0){
                Child::create([
                    'barangay_id' => auth()->user()->barangay_id,
                    'childs_name' => $row['childs_name'],
                    'mothers_name' => $row['mothers_name'],
                    'fathers_name' => $row['fathers_name'],
                    'date_of_birth' => (DateTime::createFromFormat('Y-m-d', $row['birth_day']) !== false) ? $row['birth_day'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_day']),
                    'place_of_birth' => $row['place_of_birth'],
                    'gender' => $row['gender'],
                    'date_of_registration' => (DateTime::createFromFormat('Y-m-d', $row['date_of_registration']) !== false)? $row['date_of_registration'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_registration']),
                    'birth_height' => $row['birth_height'],
                    'birth_weight' => $row['birth_weight'],
                    'address' => $row['address'],
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.childs_name' => ['childs_name', 'unique:children']
        ];
    }


    public function chunkSize(): int
    {
        return 1000;
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
