<?php

namespace App\Livewire;

use App\Actions\CreatePdfFromDocx;
use App\Models\DoctorFormPatient;
use App\Models\DoctorFormPhysician;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

class CreateDoctorOrder extends Component
{   
    use WithFileUploads;

    public $order_date;
    public $patient_first_name;
    public $patient_last_name;
    public $patient_dob;
    public $patient_address;
    public $patient_city;
    public $patient_state;
    public $patient_postal_code;
    public $patient_phone_no;
    public $primary_insurance;
    public $policy_no;
    public $private_insurance;
    public $private_insurance_no;
    public $height;
    public $weight;
    public $braces;

    public $physician_name;
    public $physician_npi;
    public $physician_address;    
    public $physician_city;
    public $physician_state;
    public $physician_postal_code;
    public $physician_number;
    public $physician_fax_number;
    public $physician_signature;
    public $physician_signed_date;

    protected $rules = [
        // First Column
        'order_date' => 'required|date',
        'patient_first_name' => 'required|string|max:255',
        'patient_last_name' => 'required|string|max:255',
        'patient_dob' => 'required|date',
        'patient_address' => 'required|string|max:255',
        'patient_city' => 'required|string|max:255',
        'patient_state' => 'required|string|max:255',
        'patient_postal_code' => 'required|string|max:10',
        'patient_phone_no' => 'required|string|max:255',
        'primary_insurance' => 'string|max:255',
        'policy_no' => 'string|max:255',
        'private_insurance' => 'string|max:255',
        'private_insurance_no' => 'string|max:255',
        'height' => 'required|string|max:10',
        'weight' => 'required|string|max:10',
        'braces' => 'required',

        // Second Column
        'physician_name' => 'required|string|max:255',
        'physician_npi' => 'required|string|max:20',
        'physician_address' => 'required|string|max:255',
        'physician_city' => 'required|string|max:255',
        'physician_state' => 'required|string|max:255',
        'physician_postal_code' => 'required|string|max:10',
        'physician_number' => 'required|string|max:255',
        'physician_fax_number' => 'required|string|max:255',
        'physician_signature' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'physician_signed_date' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];

    protected $messages = [
        // Custom error messages for validation
        'order_date.required' => 'The order date is required.',
        'patient_first_name.required' => 'The patient first name is required.',
        'patient_last_name.required' => 'The patient last name is required.',
        'patient_dob.required' => 'The patient date of birth is required.',
        'patient_address.required' => 'The patient address is required.',
        'patient_city.required' => 'The patient city is required.',
        'patient_state.required' => 'The patient state is required.',
        'patient_postal_code.required' => 'The patient postal code is required.',
        'patient_phone_no.required' => 'The patient phone number is required.',
        'primary_insurance.required' => 'The primary insurance is required.',
        'policy_no.required' => 'The policy number is required.',
        'private_insurance.required' => 'The private insurance is required.',
        'height.required' => 'The height is required.',
        'weight.required' => 'The weight is required.',
        'physician_name.required' => 'The physician name is required.',
        'physician_npi.required' => 'The physician NPI is required.',
        'physician_city.required' => 'The physician city is required.',
        'physician_state.required' => 'The physician state is required.',
        'physician_postal_code.required' => 'The physician postal code is required.',
        'physician_number.required' => 'The physician number is required.',
        'physician_signature.image' => 'The physician signature must be an image.',
        'physician_signed_date.image' => 'The physician signed date must be an image.',
        'braces.required' => "The brace option is required."
    ];

    public function submit()
    {    
        $validatedData = $this->validate();

        //Temporary Signature and Signed Date file locations
        $validatedData['physician_signature'] = $this->getSignatureTempPath();
        $validatedData['physician_signed_date'] = $this->getSignedTempPath();

        return CreatePdfFromDocx::make()
            ->handle($validatedData); 

        // session()->flash('message', 'The form has been submitted successfully.');
    }

    public function getSignatureTempPath()
    {   
        return $this->physician_signature->getRealPath();
    }

    public function getSignedTempPath()
    {   
        return $this->physician_signed_date->getRealPath();
    }

    public function render()
    {
        return view('livewire.create-doctor-order');
    }
}
