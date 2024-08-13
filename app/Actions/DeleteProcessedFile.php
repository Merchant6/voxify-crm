<?php

namespace App\Actions;

use App\Models\FilesProcessed;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteProcessedFile
{
    use AsAction;

    public function __construct(public FilesProcessed $model)
    {

    }

    public function handle(string $id)
    {
        $record = $this->model->where('id', $id);
        $first = $record->first();

        $deleteRecord = $record->delete();

        $sheetName = $first->file_name;
        $sheetPath = public_path("/storage/excel/$sheetName");
        $sheetExists = File::exists($sheetPath);

        if($sheetExists){
            File::delete($sheetPath);
        }

        return redirect()->back();
    }
}
