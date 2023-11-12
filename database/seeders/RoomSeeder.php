<?php

namespace Database\Seeders;

use App\Models\Room;
use Database\Seeders\Support\ReadJsonFile;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    private const DATA_ROOMS_JSON = 'data/rooms.json';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = ReadJsonFile::read(database_path(self::DATA_ROOMS_JSON));

        foreach ($rooms as $room) {
            Room::factory()->create([
                'id' => $room['id'],
                'name' => $room['name'],
                'capacity' => $room['capacity']
            ]);
        }
    }
}
