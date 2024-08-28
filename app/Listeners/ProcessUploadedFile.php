<?php

namespace App\Listeners;

use App\Actions\ProcessXlsx;
use App\Events\FileUploaded;
use App\Models\FilesProcessed;
use App\Models\FilesProcessedPivot;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessUploadedFile
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileUploaded $event): void
    {
        $filePath = $event->filePath;

        $filename = last(explode(DIRECTORY_SEPARATOR, $filePath));
        $insert = FilesProcessed::create([
            'file_name' => $filename,
            'is_processed' => true
        ]);

        ProcessXlsx::run($filePath, $insert->id);
    }
}
