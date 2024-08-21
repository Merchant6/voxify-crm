<?php

namespace App\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;
use PhpOffice\PhpWord\TemplateProcessor;
use Faker\Factory as Faker;

class CreatePdfFromDocx
{
    use AsAction;

    public array $templates = [];
    public mixed $faker;


    public function __construct()
    {
        $this->templates = [
            'back-braces' => public_path('/doc-temp/back-braces.docx'),
        ]; 

        $this->faker = Faker::create();
    }

    public function handle(array $data)
    {
        $value = match ($data['braces']) {
            'both-wrist-braces' => 'Both Wrists',
            'back-braces' => $this->processBackBraces($data),
            'both-elbow-braces' => 'Both Elbow',
            'left-wrist-braces' => 'Left Wrist',
            'right-shoulder-braces' => 'Right Shoulder',
            'both-knee-braces' => 'Both Knee',
            'right-wrist-brace' => 'Right Wrist',
            'left-shoulder-brace' => 'Left Shoulder',
            'left-ankle-brace' => 'Left Ankle',
            'both-ankle-braces' => 'Both Ankle',
            'right-ankle-brace' => 'Right Ankle',
        };

        return $value;
    }

    public function makeTemplateProcessor(string $template)
    {
        return new TemplateProcessor($template);
    }

    public function processBackBraces(array $data)
    {
        $template = $this->templates['back-braces'];
        $processor = $this->makeTemplateProcessor($template);

        $processor->setValues([
            'order_date' => $data['order_date'],
            'fname' => $data['patient_first_name'],
            'lname' => $data['patient_last_name'],
            'dob' => $data['patient_dob'],
            'address' => $data['patient_address'],
            'city' => $data['patient_city'],
            'state' => $data['patient_state'],
            'postal_code' => $data['patient_postal_code'],
            'phone_num' => $data['patient_phone_no'],
            'policy_num' => $data['policy_no'],
            'private_ins' => $data['private_insurance'] ?? ' - ',
            'height' => $data['height'],
            'weight' => $data['weight'],
            'phy_name' => $data['physician_name'],
            'phy_npi' => $data['physician_npi'],
            'phy_address' => $data['physician_address'],
            'phy_city' => $data['physician_city'],
            'phy_state' => $data['physician_state'],
            'phy_postal_code' => $data['physician_postal_code'],
            'phy_phone_num' => $data['physician_number'],
            'phy_fax' => $data['physician_fax_number'],
        ]);
        
        $processor->setImageValue('phy_signature', [
            'path' => $data['physician_signature'],
            'width' => 100,
            'height' => 70,
        ]);

        $processor->setImageValue('phy_signed_date', [
            'path' => $data['physician_signed_date'],
            'width' => 100,
            'height' => 70,
        ]);

        $tempFile = tempnam(sys_get_temp_dir(), 'Voxify-Doctor-Order');
        $processor->saveAs($tempFile);

        $filename = basename($tempFile) . '.docx';
        return response()->streamDownload(function () use ($tempFile, $filename) {
            $stream = fopen($tempFile, 'rb');
            fpassthru($stream);
            fclose($stream);
    
            unlink($tempFile);
        }, $filename, [
            'Content-Disposition' => 'attachment; filename="'  . $filename . '"',
        ]);
    }
}
