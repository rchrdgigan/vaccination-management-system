<?php

namespace App\Imports;

use App\Models\Child;
use App\Models\ChildVaccine;
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
use DateTime;

class ChildVaccinesImport implements 
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

            $cb_date = (DateTime::createFromFormat('Y-m-d', $row['date_of_birth']) !== false) ? $row['date_of_birth'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']);
            
            $c_count = Child::where('barangay_id', auth()->user()->barangay_id)
            ->where('childs_name', $row['child_name'])->where('date_of_birth', $cb_date)->count();
            
            if($c_count !== 0){

                $v_count = Vaccine::where('barangay_id', auth()->user()->barangay_id)
                    ->where('vaccines_name', $row['vaccine'])->where('has_dose',$row['dose'])->count();
              
                if($v_count !== 0 ){

                    $c = Child::where('barangay_id', auth()->user()->barangay_id)
                    ->where('childs_name', $row['child_name'])->where('date_of_birth', $cb_date)->first();

                    $v = Vaccine::where('barangay_id', auth()->user()->barangay_id)
                    ->where('vaccines_name', $row['vaccine'])->where('has_dose',$row['dose'])->first();

                    $cv = ChildVaccine::where('child_id', $c->id)->where('vaccine_id', $v->id)->count();

                    if($cv !== 0){

                        $cv = ChildVaccine::where('child_id', $c->id)->where('vaccine_id', $v->id)->first();

                        $strArrVar = array( 'has_inj_1st_dose',
                                            'has_inj_2nd_dose',
                                            'has_inj_3rd_dose',
                                        );

                        $set_stat = $cv->where( $strArrVar[$row['dose'] - 1], true)->where('id', $cv->id)->get();

                        $child_vacc_update = ChildVaccine::where('id', $cv->id)->update([
                            'has_inj_1st_dose' => (!isset($row['1st_dose'])) ? $row['1st_dose'] = false : $row['1st_dose'],
                            'has_inj_2nd_dose' => (!isset($row['2nd_dose'])) ? $row['2nd_dose'] = false : $row['2nd_dose'],
                            'has_inj_3rd_dose' => (!isset($row['3rd_dose'])) ? $row['3rd_dose'] = false : $row['3rd_dose'],
                            'inj_1st_date' => (!isset($row['1st_injected_date'])) ? $row['1st_injected_date'] = null : (DateTime::createFromFormat('Y-m-d H:i:s', $row['1st_injected_date']) !== false ? $row['1st_injected_date'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['1st_injected_date'])),
                            'inj_2nd_date' => (!isset($row['2nd_injected_date'])) ? $row['2nd_injected_date'] = null : (DateTime::createFromFormat('Y-m-d H:i:s', $row['2nd_injected_date']) !== false ? $row['2nd_injected_date'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['2nd_injected_date'])),
                            'inj_3rd_date' => (!isset($row['3rd_injected_date'])) ? $row['3rd_injected_date'] = null : (DateTime::createFromFormat('Y-m-d H:i:s', $row['3rd_injected_date']) !== false ? $row['3rd_injected_date'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['3rd_injected_date'])),
                            'status' => ($set_stat->isEmpty())? 'Partial-Vaccinated' : 'Fully-Vaccinated',
                        ]);

                    }else{

                        $child_vacc_create = ChildVaccine::create([
                            'barangay_id' => auth()->user()->barangay_id,
                            'child_id' => $c->id,
                            'vaccine_id' => $v->id,
                            'has_inj_1st_dose' => (!isset($row['1st_dose'])) ? $row['1st_dose'] = false : $row['1st_dose'],
                            'has_inj_2nd_dose' => (!isset($row['2nd_dose'])) ? $row['2nd_dose'] = false : $row['2nd_dose'],
                            'has_inj_3rd_dose' => (!isset($row['3rd_dose'])) ? $row['3rd_dose'] = false : $row['3rd_dose'],
                            'inj_1st_date' => (!isset($row['1st_injected_date'])) ? $row['1st_injected_date'] = null : (DateTime::createFromFormat('Y-m-d H:i:s', $row['1st_injected_date']) !== false ? $row['1st_injected_date'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['1st_injected_date'])),
                            'inj_2nd_date' => (!isset($row['2nd_injected_date'])) ? $row['2nd_injected_date'] = null : (DateTime::createFromFormat('Y-m-d H:i:s', $row['2nd_injected_date']) !== false ? $row['2nd_injected_date'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['2nd_injected_date'])),
                            'inj_3rd_date' => (!isset($row['3rd_injected_date'])) ? $row['3rd_injected_date'] = null : (DateTime::createFromFormat('Y-m-d H:i:s', $row['3rd_injected_date']) !== false ? $row['3rd_injected_date'] : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['3rd_injected_date'])),
                        ]);
                        
                    }
                }
            }
        }
    }
    public function rules(): array
    {
        return [
            '*.vaccines_name' => ['vaccine', 'unique:vaccines']
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
