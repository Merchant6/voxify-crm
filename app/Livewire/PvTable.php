<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PvPatient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PvTable extends DataTableComponent
{
    protected $model = PvPatient::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {

                return route('pv-pdf', [
                    'record' => $row,
                ]);

            });
        $this->setEagerLoadAllRelationsEnabled();

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("First name", "first_name")
                ->searchable(),
            Column::make("Last name", "last_name")
                ->searchable(),
            Column::make("Dob", "dob")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Mb id", "mb_id")
                ->searchable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("City", "city")
                ->sortable(),
            Column::make("State", "state")
                ->sortable(),
            Column::make("Zip code", "zip_code")
                ->sortable(),
            Column::make("Height", "height")
                ->sortable(),
            Column::make("Weight", "weight")
                ->sortable(),
            Column::make("Doctor Name", "doctor.name")
                ->searchable(),
            Column::make("Doctor Address", "doctor.address")
                ->sortable(),
            Column::make("Doctor City", "doctor.city")
                ->sortable(),
            Column::make("Doctor State", "doctor.state")
                ->sortable(),
            Column::make("Doctor Zip Code", "doctor.zip_code")
                ->sortable(),
            Column::make("Doctor Phone", "doctor.phone")
                ->sortable(),
            Column::make("Doctor Fax", "doctor.fax")
                ->sortable(),
            Column::make("Doctor NPI", "doctor.npi")
                ->sortable(),
        ];
    }

}
