<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorFormPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'first_name',
        'last_name',
        'dob',
        'address',
        'city',
        'state',
        'postal_code',
        'phone',
        'primary_insurance',
        'policy_number',
        'private_insurance',
        'private_insurance_number',
        'height',
        'width',
        'brace',
    ];
}
