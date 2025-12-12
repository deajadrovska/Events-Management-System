<?php

namespace Database\Factories;

use App\Enums\EventTypeEnum;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(3),
            'date' => fake()->dateTimeBetween('now', '+1 year'),
            'type' => fake()->randomElement(EventTypeEnum::cases())->value,
            'organizer_id' => Organizer::factory(),
        ];
    }
}
