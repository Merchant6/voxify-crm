<?php

namespace App\Actions;

use App\Models\PvPatient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;
use PhpOffice\PhpWord\TemplateProcessor;
use NcJoes\OfficeConverter\OfficeConverter;

class CreatePvPdf
{
    use AsAction;

    public array $headers = [
        'Content-Type: application/pdf',
    ];

    public function handle(string $query)
    {
        $record = $this->get($query);

        if(!$record){
            return response()->noContent();
        }

        $template = public_path("/storage/pv-pdf/pv.docx");
        
        //Address
        $street = $record['address'];
        $city = $record['city'];
        $state = $record['state'];
        $zip = $record['zip_code'];

        //Full Address
        $address = "$street, $city, $state, $zip";
        Log::info($address);

        $word = new TemplateProcessor($template);
        $word->setValue('DOCTOR NAME', $record['doctor.name']);
        $word->setValue('DOCTOR ADDRESS', $record['doctor.address']);
        $word->setValue('DOCTOR PHONE', $record['doctor.phone']);
        $word->setValue('DOCTOR FAX', $record['doctor.fax']);
        $word->setValue('PATIENT NAME', $record['first_name'] . ' ' . $record['last_name']);
        $word->setValue('PATIENT DOB', $record['dob']);
        $word->setValue('PATIENT MBI', $record['mb_id']);
        $word->setValue('PATIENT PHONE', $record['phone']);
        $word->setValue('PATIENT ADDRESS', $address);
        $word->setValue('DOCTOR NPI', $record['doctor.npi']);
        $word->setValue('DATE', date('d/m/y'));

        $mb_id = $record['mb_id'];
        $filename = "pv-patient-$mb_id";
        $filenameWithExtenstion = "pv-patient-$mb_id.docx";
        $word->saveAs($filenameWithExtenstion);
        
        $path = public_path($filenameWithExtenstion);
        $downloadFile = $this->docxToPdf($path, $filename);

        return response()->download($downloadFile);
    }

    public function get(string $query): array|bool
    {
        $row = PvPatient::where('id', $query)
            ->with('doctor')
            ->limit(1)
            ->get();

        if($row->count() < 1){
            return false;
        }

        $row = $row->toArray();
        $data = Arr::dot($row[0]);
        
        return $data;
    }

    public function docxToPdf(string $path, $outputFilename)
    {   
        $outputPdfName = "$outputFilename.pdf";

        $converter = new OfficeConverter($path, public_path());
        $converter->convertTo($outputPdfName);

        return public_path($outputPdfName);
    }
}
