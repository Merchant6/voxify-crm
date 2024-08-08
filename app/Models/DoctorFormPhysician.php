<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorFormPhysician extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npi',
        'city',
        'state',
        'postal_code',
        'number',
        'fax_number',
        'signature',
        'signed_date',
    ];
}
