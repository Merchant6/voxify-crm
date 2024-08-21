<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DoctorFormPatient;
use App\Models\DoctorFormPhysician;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class DoctorOrders extends DataTableComponent
{
    protected $model = DoctorFormPatient::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->eagerLoadAllRelationsIsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable(),
            // Column::make("Physician id", "physician_id")
            //     ->searchable(),
            Column::make("Order date", "order_date")
                ->searchable(),
            Column::make("First name", "first_name")
                ->searchable(),
            Column::make("Last name", "last_name")
                ->searchable(),
            Column::make("Dob", "dob")
                ->searchable(),
            Column::make("Address", "address")
                ->searchable(),
            Column::make("City", "city")
                ->searchable(),
            Column::make("State", "state")
                ->searchable(),
            Column::make("Postal code", "postal_code")
                ->searchable(),
            Column::make("Phone", "phone")
                ->searchable(),
            Column::make("Primary insurance", "primary_insurance")
                ->searchable(),
            Column::make("Policy number", "policy_number")
                ->searchable(),
            Column::make("Private insurance", "private_insurance")
                ->searchable(),
            Column::make("Private insurance number", "private_insurance_number")
                ->searchable(),
            Column::make("Height", "height")
                ->searchable(),
            Column::make("Weight", "weight")
                ->searchable(),
            Column::make("Brace", "brace")
                ->searchable(),
            Column::make("Physician Name", "doctorFormPhysician.name")
                ->searchable(),
            Column::make("Physician NPI", "doctorFormPhysician.npi")
                ->searchable(),
            Column::make("Physician City", "doctorFormPhysician.city")
                ->searchable(),
            Column::make("Physician State", "doctorFormPhysician.state")
                ->searchable(),
            Column::make("Physician Postal Code", "doctorFormPhysician.postal_code")
                ->searchable(),
            Column::make("Physician Number", "doctorFormPhysician.number")
                ->searchable(),
            Column::make("Physician Fax Number", "doctorFormPhysician.fax_number")
                ->searchable(),
            ImageColumn::make("Physician Signature", "doctorFormPhysician.signature")
                ->location(
                    fn($row) => DoctorFormPhysician::where('id', $row->id)
                                    ->value('signature')
                ),
            ImageColumn::make("Physician Signed Date", "doctorFormPhysician.signed_date")
                ->location(
                    fn($row) => DoctorFormPhysician::where('id', $row->id)
                                    ->value('signed_date')
                ),

        ];
    }
}
