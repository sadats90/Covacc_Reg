<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a Faker instance
        $faker = Faker::create();

        // Insert random users
        foreach (range(1, 50) as $index) { // Adjust the range as needed for the number of users
            User::create([
                'nid' => $faker->unique()->numerify('NID#####'), // Generate a unique National ID
                'name' => $faker->name, // Random name
                'email' => $faker->unique()->safeEmail, // Random unique email
                'vaccine_center_id' => $faker->numberBetween(1, 31), // Random vaccine center ID between 1 and 31
                'password' => '11111111', // Default password (bcrypt)
                'status' => 'Not scheduled', // Default status
                'scheduled_date' => Carbon::now()->addDays(rand(7, 15))->toDateString(),
            ]);
        }
    }
}
