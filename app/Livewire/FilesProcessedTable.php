<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FilesProcessed;

class FilesProcessedTable extends DataTableComponent
{
    protected $model = FilesProcessed::class;
    
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {

                return route('pv-table', [
                    'file' => $row,
                ]);

            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id"),
            Column::make("File name", "file_name")
                ->searchable(),
            Column::make("Is processed", "is_processed"),
        ];
    }
}
