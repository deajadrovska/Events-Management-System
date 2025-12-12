<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Organizer::query()
                ->create([
                    'full_name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'phone_number' => $faker->phoneNumber,
                ]);
        }
    }
}
