<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'files_processed_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id',
        'pv_doctor_id'
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(PvDoctor::class, 'id');
    }

    public function filesProcessed(): BelongsTo
    {   
        return $this->belongsTo(FilesProcessed::class);
    }
}
