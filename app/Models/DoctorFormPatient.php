<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorFormPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'physician_id',
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
        'weight',
        'brace',
    ];

    public function doctorFormPhysician(): BelongsTo
    {
        return $this->belongsTo(DoctorFormPhysician::class, 'id');
    }
}
