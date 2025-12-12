<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 20 organizers using Factory Pattern
        Organizer::factory(20)->create();

        // Create 50 events using Factory Pattern
        // Each event will be assigned to a random existing organizer
        $organizers = Organizer::all();

        Event::factory(50)->create([
            'organizer_id' => fn() => $organizers->random()->id,
        ]);
    }
}
