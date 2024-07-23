<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvDoctor extends Model
{
    use HasFactory;

    protected $table = 'pv_doctor';

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'phone',
        'fax',
        'npi',
    ];
    
    public function patients()
    {
        return $this->hasMany(PvPatient::class);
    }
}
