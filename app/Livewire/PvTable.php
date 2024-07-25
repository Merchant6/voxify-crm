<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PvPatient;

class PvTable extends DataTableComponent
{
    protected $model = PvPatient::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setEagerLoadAllRelationsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("First name", "first_name")
                ->searchable()
                ->sortable(),
            Column::make("Last name", "last_name")
                ->searchable()
                ->sortable(),
            Column::make("Dob", "dob")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Mb id", "mb_id")
                ->sortable(),
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
                ->searchable()
                ->sortable(),
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
                ->searchable()
                ->sortable(),
            Column::make("Doctor NPI", "doctor.npi")
                ->searchable()
                ->sortable(),
        ];
    }
}
