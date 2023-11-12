<?php

namespace Database\Seeders;

use App\Models\Booking;
use Database\Seeders\Support\ReadJsonFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    private const DATA_BOOKINGS_JSON = 'data/bookings.json';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = ReadJsonFile::read(database_path(self::DATA_BOOKINGS_JSON));

        foreach ($bookings as $booking) {
            Booking::factory()->create([
                'id' => $booking['id'],
                'room_id' => $booking['room_id'],
                'booked_for' => $booking['booked_for'],
                'start_date' => $booking['start_date'],
                'end_date' => $booking['end_date']
            ]);
        }
    }
}
