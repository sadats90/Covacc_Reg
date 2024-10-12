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
    
        $faker = Faker::create();

       
        foreach (range(1, 50) as $index) { 
            User::create([
                'nid' => $faker->unique()->numberBetween(100000, 999999), 
                'name' => $faker->name, 
                'email' => $faker->unique()->safeEmail, 
                'vaccine_center_id' => $faker->numberBetween(1, 29), 
                'password' => '11111111', 
                'status' => 'Not scheduled', 
                'scheduled_date' => Carbon::now()->addDays(rand(7, 15))->toDateString(),
            ]);
        }
    }
}
