<?php

namespace Database\Seeders;

use App\Models\DoctorFormPatient;
use App\Models\DoctorFormPhysician;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DoctorFormPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();  

        $braces = [
            'Back Braces',
            'Both Knee Brace',
            'Left Knee Brace',
            'Both Ankle Brace',
            'Both Wrist Brace',
            'Left Wrist Brace',
            'Left Elbow Brace',
            'Both Elbow Brace',
        ];

        // Get a random doctor ID
        $doctorId = DoctorFormPhysician::inRandomOrder()->first()->id;

        // Generate a specific number of patient records (modify as needed)
        $numberOfPatients = 100;

        for ($i = 0; $i < $numberOfPatients; $i++) {

            shuffle($braces);

            DoctorFormPatient::create([
                'physician_id' => $doctorId,
                'order_date' => $faker->date(),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'dob' => $faker->date(),
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'postal_code' => $faker->postcode(),
                'phone' => $faker->phoneNumber,
                'primary_insurance' => $faker->phoneNumber(),
                'policy_number' => $faker->numberBetween(10000, 9999999),
                'private_insurance' => $faker->text(20),
                'private_insurance_number' => $faker->numberBetween(10000, 9999999),
                'height' => $faker->randomFloat(),
                'weight' => $faker->numberBetween(50, 120),
                'brace' =>  $braces[0],
            ]);
        }
    }
}
