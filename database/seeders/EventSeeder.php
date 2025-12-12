<?php

namespace Database\Seeders;

use App\Enums\EventTypeEnum;
use App\Models\Event;
use App\Models\Organizer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $organizers = Organizer::all();

        if ($organizers->isEmpty()) {
            $this->command->info('No organizers found. Please run OrganizerSeeder first.');
            return;
        }

        $eventTypes = EventTypeEnum::cases();

        foreach (range(1, 20) as $index) {
            Event::query()
                ->create([
                    'name' => $faker->sentence(3),
                    'description' => $faker->paragraph(3),
                    'date' => $faker->dateTimeBetween('now', '+1 year'),
                    'type' => $faker->randomElement($eventTypes)->value,
                    'organizer_id' => $organizers->random()->id,
                ]);
        }
    }
}
