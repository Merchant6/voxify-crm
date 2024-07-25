<?php

namespace App\Actions;

use App\Models\PvDoctor;
use App\Models\PvPatient;
use Illuminate\Support\Facades\Date as FacadesDate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ProcessXlsx
{
    use AsAction;

    protected array $pvPatient = [];
    protected array $pvDoctor = [];
    protected int $totalHeadings = 19;

    public function handle(string $filePath)
    {   
        //Fully Qualified File Path 
        $fqfp = public_path() . '/storage/' . $filePath;

        //Spreadsheet
        $spreadsheet = $this->initReader($fqfp);
        $this->spreadsheetToArray($spreadsheet);

        $rows = [];
        $rows['patients'] = $this->pvPatient;
        $rows['doctors'] = $this->pvDoctor;

        Log::info(json_encode($rows, JSON_PRETTY_PRINT));
    }

    public function spreadsheetToArray(Spreadsheet $spreadsheet): void
    {
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            $cells = [];
            foreach ($cellIterator as $cell) {

                $cells[] = $cell->getFormattedValue();
    
            }
            $rows[] = $cells;
        }
        Log::info(json_encode($rows, JSON_PRETTY_PRINT));
        $this->bulkInsert($rows);
    }

    public function initReader(string $file): Spreadsheet
    { 
        $reader = new Xlsx();
        return $reader->load($file);
    }

    public function splitArrayValues(array $array)
    {   
        array_shift($array);

        $patientData = [];
        $doctorData = [];

        foreach ($array as $record) {
            // Extract patient information
            $patientInfo = array_slice($record, 0, 11);
            $patientData[] = $patientInfo;

            // Extract doctor information
            $doctorInfo = array_slice($record, 11);
            $doctorData[] = $doctorInfo;
        }

        $this->pvPatient = $patientData;
        $this->pvDoctor = $doctorData;
    }

    public function bulkInsert(array $rows)
    {
        $this->splitArrayValues($rows);

        // Define column mappings
        $doctorColumns = ['name', 'address', 'city', 'state', 'zip_code', 'phone', 'fax', 'npi'];
        $patientColumns = ['first_name', 'last_name', 'dob', 'phone', 'mb_id', 'address', 'city', 'state', 'zip_code', 'height', 'weight'];

        $doctorData = [];
        $patientData = [];
        
        foreach ($this->pvDoctor as $record) {
            $doctorData[] = array_combine($doctorColumns, $record);
        }
    
        foreach ($this->pvPatient as $record) {
            $patientData[] = array_combine($patientColumns, $record);
        }

        PvDoctor::insert($doctorData);

        $doctorIds = PvDoctor::latest()->take(count($doctorData))->pluck('id');

        $patientDataWithDoctorId = [];
        foreach ($patientData as $index => $patient) {
            $patientDataWithDoctorId[] = array_merge(['pv_doctor_id' => $doctorIds[$index]], $patient);
        }

        PvPatient::insert($patientDataWithDoctorId);
    }
}
