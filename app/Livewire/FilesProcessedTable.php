<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FilesProcessed;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

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

        // $this->useComputedPropertiesDisabled();    
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id"),
            Column::make("File name", "file_name")
                ->searchable(),
            Column::make("Is processed", "is_processed"),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Delete')
                        ->title(fn($row) => 'Delete')
                        ->location(fn($row) => route('delete-sheet', [
                            'id' => $row,
                        ]))
                        ->attributes(function($row) {

                            return [
            
                                'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
            
                            ];
            
                        }),
                ]),
        ];
    }
}
