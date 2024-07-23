<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvPatient extends Model
{
    use HasFactory;

    protected $table = 'pv_patient';

    protected $fillable = [
        'pv_doctor_id',
        'first_name',
        'last_name',
        'dob',
        'phone',
        'mb_id',
        'address',
        'city',
        'state',
        'zip_code',
        'height',
        'weight',
        'pain',
    ];

    public function doctor()
    {
        return $this->belongsTo(PvDoctor::class);
    }
}
