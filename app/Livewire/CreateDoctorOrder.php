<?php

namespace App\Livewire;

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
        'primary_insurance' => 'required|string|max:255',
        'policy_no' => 'required|string|max:255',
        'private_insurance' => 'required|string|max:255',
        'private_insurance_no' => 'required|string|max:255',
        'height' => 'required|string|max:10',
        'weight' => 'required|string|max:10',
        'braces' => 'required',

        // Second Column
        'physician_name' => 'required|string|max:255',
        'physician_npi' => 'required|string|max:20',
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

    public string $signature = 'images/signature/';
    public string $signedDate = 'images/signed-date/';

    public function submit()
    {    
        $this->validate();

        $this->transaction();

        session()->flash('message', 'The form has been submitted successfully.');
    }

    public function transaction()
    {
        return DB::transaction(function () {
            $this->savePatient();
            $this->saveDoctor();
        });
    }

    public function savePatient()
    {
        return DoctorFormPatient::create([
            'order_date' => $this->order_date,
            'first_name' => $this->patient_first_name,
            'last_name'=> $this->patient_last_name,
            'dob' => $this->patient_dob,
            'address' => $this->patient_address,
            'city' => $this->patient_city,
            'state' => $this->patient_state,
            'postal_code' => $this->patient_postal_code,
            'phone' => $this->patient_phone_no,
            'primary_insurance' => $this->primary_insurance,
            'policy_number' => $this->policy_no,
            'private_insurance' => $this->private_insurance,
            'private_insurance_number' => $this->private_insurance_no,
            'height' => $this->height,
            'width' => $this->weight,
            'brace' => $this->braces,
        ]);
    }

    public function saveDoctor()
    {
        return DoctorFormPhysician::create([
            'name' => $this->physician_name,
            'npi'=> $this->physician_npi,
            'city' => $this->physician_city,
            'state'=> $this->physician_state,
            'postal_code' => $this->physician_postal_code,
            'number' => $this->physician_number,
            'fax_number' => $this->physician_fax_number,
            'signature' => $this->saveSignature(),
            'signed_date' => $this->saveSignedDate(),
        ]);
    }

    public function saveSignature()
    {   
        $extension = $this->physician_signature->getClientOriginalExtension();
        $uniqid = uniqid('signature_', true);
        $fileName =  "$uniqid.$extension";

        $this->physician_signature->storeAs($this->signature, $fileName, 'public');

        return public_path("/$this->signature . $fileName");
    }

    public function saveSignedDate()
    {   
        $extension = $this->physician_signed_date->getClientOriginalExtension();
        $uniqid = uniqid('signedDate_', true);
        $fileName = "$uniqid.$extension";

        $this->physician_signed_date->storeAs($this->signedDate, $fileName, 'public');

        return $this->signedDate . $fileName;
    }

    public function render()
    {
        return view('livewire.create-doctor-order');
    }
}
