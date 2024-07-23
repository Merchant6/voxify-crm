<?php

namespace App\Listeners;

use App\Actions\ProcessXlsx;
use App\Events\FileUploaded;
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
        ProcessXlsx::run($filePath);
    }
}
