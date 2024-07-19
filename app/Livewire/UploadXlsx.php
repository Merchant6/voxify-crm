<?php

namespace App\Livewire;

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

        $path = $this->file->storeAs('/excel', $filename, 'public');
        session()->flash('message', 'File uploaded successfully, is now being processed.');
    }

    public function render()
    {
        return view('livewire.upload-xlsx');
    }
}
