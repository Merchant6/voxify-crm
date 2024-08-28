<?php

namespace App\Actions;

use App\Models\PvPatient;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use PhpOffice\PhpWord\TemplateProcessor;
use NcJoes\OfficeConverter\OfficeConverter;
use ZipArchive;

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

        $template = public_path(DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'pv-pdf' . DIRECTORY_SEPARATOR . 'pv.docx');
        
        //Address
        $street = $record['address'];
        $city = $record['city'];
        $state = $record['state'];
        $zip = $record['zip_code'];

        //Full Address
        $address = "$street, $city, $state, $zip";
    
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
        
        $publicPathwithBaseName = public_path("bulk" . DIRECTORY_SEPARATOR . basename($downloadFile));

        File::move($downloadFile, $publicPathwithBaseName);
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

        File::delete($path);

        return public_path($outputPdfName);
    }

    public function zip()
    {   
        $date = date('d-m-Y');

        $zip = new ZipArchive();
        $zipFilename = "PV-PDFs-$date.zip";

        if($zip->open(public_path($zipFilename), ZipArchive::CREATE) == true){

            $files = File::files(public_path('bulk'));
            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }

        (new Filesystem)->cleanDirectory(public_path('bulk'));

        return response()->download(public_path($zipFilename));
    }
}
