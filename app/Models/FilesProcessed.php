<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FilesProcessed extends Model
{
    use HasFactory;

    protected $table = 'files_processed';

    protected $fillable = [
        'file_name',
        'is_processed'
    ];

    protected $hidden = [
        // 'id',
        'created_at',
        'updated_at'
    ];

    public function pvPatient(): HasMany
    {
        return $this->hasMany(PvPatient::class);
    }

}
