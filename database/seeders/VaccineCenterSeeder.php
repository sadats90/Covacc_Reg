<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VaccineCenter;
use Faker\Factory as Faker;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a Faker instance
        $faker = Faker::create();

        // Insert random vaccine centers
        foreach (range(1, 30) as $index) {
            VaccineCenter::create([
                'name' => $faker->company . ' Vaccine Center', // Random company name
                'daily_limit' => $faker->numberBetween(50, 200), // Random daily limit between 50 and 200
            ]);
        }
    }
}
