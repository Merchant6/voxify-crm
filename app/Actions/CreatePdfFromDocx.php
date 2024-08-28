<?php

namespace App\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;
use NcJoes\OfficeConverter\OfficeConverter;
use PhpOffice\PhpWord\TemplateProcessor;
use Faker\Factory as Faker;

class CreatePdfFromDocx
{
    use AsAction;

    /**
     * Holds the DOCX templates to be converted to PDFs
     * @var array
     */
    public array $templates = [];

    public function __construct()
    {
        $this->templates = [
            'back-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'back-braces.docx'),
            'both-elbow-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'both-elbow-braces.docx'),
            'right-shoulder-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'right-shoulder-braces.docx'),
            'both-knee-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'both-knee-braces.docx'),
            'right-wrist-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'right-wrist-braces.docx'),
            'left-shoulder-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'left-shoulder-braces.docx'),
            'left-ankle-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'left-ankle-braces.docx'),
            'both-ankle-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'both-ankle-braces.docx'),
            'right-ankle-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'right-ankle-braces.docx'),
            'both-wrist-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'both-wrist-braces.docx'),
            'left-wrist-braces' => public_path(DIRECTORY_SEPARATOR . 'doc-temp' . DIRECTORY_SEPARATOR . 'left-wrist-braces.docx'),
        ];

    }

    public function handle(array $data)
    {   
        Log::info($data['braces']);

        $value = match ($data['braces']) {
            'both-wrist-braces' => $this->processBothWristBraces($data, 'both-wrist-braces'),
            'back-braces' => $this->processBackBraces($data, 'back-braces'),
            'both-elbow-braces' => $this->processBothElbowBraces($data, 'both-elbow-braces'),
            'left-wrist-braces' => $this->processLeftWristBraces($data, 'left-wrist-braces'),
            'right-shoulder-braces' => $this->processRightShoulderBraces($data, 'right-shoulder-braces'),
            'both-knee-braces' => $this->processBothKneeBraces($data, 'both-knee-braces'),
            'right-wrist-braces' => $this->processRightWristBraces($data, 'right-wrist-braces'),
            'left-shoulder-braces' => $this->processLeftShoulderBraces($data, 'left-shoulder-braces'),
            'left-ankle-braces' => $this->processLeftAnkleBraces($data, 'left-ankle-braces'),
            'both-ankle-braces' => $this->processBothAnkleBraces($data, 'both-ankle-braces'),
            'right-ankle-braces' => $this->processRightAnkleBraces($data, 'right-ankle-braces'),
        };

        return $value;
    }

    /**
     * Create a new PhpOffice\PhpWord\TemplateProcessor instance
     * @param string $template
     * @return TemplateProcessor
     */
    public function makeTemplateProcessor(string $template)
    {
        return new TemplateProcessor($template);
    }

    /**
     * Process a template docx file, replace placeholders,
     * and download the file
     * 
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processTemplate(array $data, string $braceName)
    {
        $template = $this->templates[$braceName];
        $processor = $this->makeTemplateProcessor($template);

        $processor->setValues([
            'order_date' => Carbon::parse($data['order_date'])->format('m/d/Y') ?? ' - ',
            'fname' => $data['patient_first_name'] ?? ' - ',
            'lname' => $data['patient_last_name'] ?? ' - ',
            'dob' => Carbon::parse($data['patient_dob'])->format('m/d/Y') ?? ' - ',
            'address' => $data['patient_address'] ?? ' - ',
            'city' => $data['patient_city'] ?? ' - ',
            'state' => $data['patient_state'] ?? ' - ',
            'postal_code' => $data['patient_postal_code'] ?? ' - ',
            'phone_num' => $data['patient_phone_no'] ?? ' - ',
            'policy_num' => $data['policy_no'] ?? ' - ',
            'primary_ins' => $data['primary_insurance'] ?? ' - ',
            'private_ins' => $data['private_insurance'] ?? ' - ',
            'height' => $data['height'] ?? ' - ',
            'weight' => $data['weight'] ?? ' - ',
            'phy_name' => $data['physician_name'] ?? ' - ',
            'phy_npi' => $data['physician_npi'] ?? ' - ',
            'phy_address' => $data['physician_address'] ?? ' - ',
            'phy_city' => $data['physician_city'] ?? ' - ',
            'phy_state' => $data['physician_state'] ?? ' - ',
            'phy_postal_code' => $data['physician_postal_code'] ?? ' - ',
            'phy_phone_num' => $data['physician_number'] ?? ' - ',
            'phy_fax' => $data['physician_fax_number'] ?? ' - ',
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

        $tempFile = tempnam(sys_get_temp_dir(), 'Voxify-Doctor-Order-');
        $filename = "$tempFile.docx";
        $processor->saveAs($filename);

        $pdfPath = $this->convertDocxToPdf($filename);

        return response()->download($pdfPath, basename($pdfPath));
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processBackBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processBothElbowBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processBothKneeBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processRightWristBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processLeftShoulderBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processLeftAnkleBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processBothAnkleBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processRightAnkleBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processBothWristBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processLeftWristBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Placeholder method for processTemplate
     * @param array $data
     * @param string $braceName
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function processRightShoulderBraces(array $data, string $braceName)
    {
        return $this->processTemplate($data, $braceName);
    }

    /**
     * Convert a DOCX file to PDF using the 
     * NcJoes\OfficeConverter\OfficeConverter class
     * 
     * @param string $filePath
     * @return string|null
     */
    public function convertDocxToPdf(string $filePath)
    {
        $converter = new OfficeConverter($filePath);
        $int = random_int(PHP_INT_MIN, PHP_INT_MAX);
        $pdfPath = $converter->convertTo("Doctor-Order-$int.pdf");

        return $pdfPath;
    }
}
