<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'event_status_id' => $this->faker->numberBetween(1, 3),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'start' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'end' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
        ];
    }
}
