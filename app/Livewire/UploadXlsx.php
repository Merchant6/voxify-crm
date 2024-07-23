<?php

namespace App\Livewire;

use App\Events\FileUploaded;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadXlsx extends Component
{   
    use WithFileUploads;

    #[Validate('file|mimes:xlsx')]
    public $file;

    public function save()
    {
        $filename = $this->file->getClientOriginalName();

        $exists = Storage::disk('public')->exists("excel/$filename");
        if(!$exists){

            $path = $this->file->storeAs('/excel', $filename, 'public');
            Session::flash('message', 'File uploaded successfully, is now being processed.');
            FileUploaded::dispatch($path);

        } else {

            Session::flash('message', 'File with this name already exists and being or has been processed!');
        }
        
    }

    public function render()
    {
        return view('livewire.upload-xlsx');
    }
}
