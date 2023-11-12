<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => Room::factory()->create()->get('id'),
            'booked_for' => fake()->safeEmail(),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime()
        ];
    }
}
