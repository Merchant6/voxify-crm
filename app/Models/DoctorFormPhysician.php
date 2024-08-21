<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function doctorFormPatients(): HasMany
    {
        return $this->hasMany(DoctorFormPatient::class, 'id');
    }
}
