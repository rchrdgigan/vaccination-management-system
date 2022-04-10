<?php

namespace App\Imports;

use App\Models\Vaccine;
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
use Throwable;

class VaccinesImport implements 
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;
    
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $vaccine = Vaccine::where('barangay_id', auth()->user()->barangay_id)
                ->where('vaccines_name', $row['vaccine'])->count();
            if($vaccine == 0){
                $vaccine = Vaccine::create([
                    'barangay_id' => auth()->user()->barangay_id,
                    'vaccines_name' => $row['vaccine'],
                    'brand_name' => $row['brand'],
                    'has_dose' => $row['dose'],
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            '*.vaccine_name' => ['vaccine', 'unique:vaccines']
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
