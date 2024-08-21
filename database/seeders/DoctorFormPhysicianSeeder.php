<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DoctorFormPhysicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();  


        // Generate a specific number of doctor records (modify as needed)
        $numberOfDoctors = 250;

        for ($i = 0; $i < $numberOfDoctors; $i++) {
            DB::table('doctor_form_physicians')->insert([
                'name' => $faker->name,
                'npi' => $faker->randomNumber(8),
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'postal_code' => $faker->postcode,
                'number' => $faker->phoneNumber,
                'fax_number' => $faker->phoneNumber,
                'signature' => "https://placehold.co/500x150", // Signature placeholder with text
                'signed_date' => "https://placehold.co/500x150", // Signed date placeholder with text
            ]);
        }
    }
}
