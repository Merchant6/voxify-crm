<?php

namespace App\Actions;

use App\Models\PvPatient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

class CreatePvPdf
{
    use AsAction;

    public function handle(string $query)
    {
        $record = $this->get($query);
        $template = public_path("/storage/pv-pdf/pv.docx");
        
        $word = new TemplateProcessor($template);
        $word->setValue('DOCTOR NAME', $record['doctor.name']);
        $word->setValue('DOCTOR ADDRESS', $record['doctor.address']);
        $word->setValue('DOCTOR PHONE', $record['doctor.phone']);
        $word->setValue('DOCTOR FAX', $record['doctor.fax']);
        $word->setValue('PATIENT NAME', $record['first_name'] . ' ' . $record['last_name']);
        $word->setValue('PATIENT DOB', $record['dob']);
        $word->setValue('PATIENT MBI', $record['mb_id']);
        $word->setValue('PATIENT PHONE', $record['phone']);
        $word->setValue('PATIENT ADDRESS', $record['address']);
        $word->setValue('DOCTOR NPI', $record['doctor.npi']);
        $word->setValue('DATE', date('d/m/y'));

        $mb_id = $record['mb_id'];
        // $word->saveAs("pv-patient-$mb_id.docx");
    }

    public function get(string $query): array
    {
        $row = PvPatient::where('id', $query)
            ->with('doctor')
            ->limit(1)
            ->get()
            ->toArray();

        $data = Arr::dot($row[0]);
        
        return $data;
    }
}
