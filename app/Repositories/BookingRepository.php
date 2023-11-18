<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Nette\NotImplementedException;
use Symfony\Component\HttpFoundation\Response;

class BookingRepository extends BaseRepository
{
    public function __construct(
        private readonly Booking $booking,
        private Room $room
    ) {
    }

    public function store(array $attributes): Model
    {
        return $this->booking->create($attributes);
    }

    public function update(int $id, array $attributes): Model|bool
    {
        throw new NotImplementedException('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    public function destroy(int $id): bool
    {
        throw new NotImplementedException('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    public function all(): Collection
    {
        return $this->booking->with('room')->get();
    }

    public function checkBookings(int $room_id, Carbon $start_date, Carbon $end_date): int
    {
        return $this->booking->newQuery()
            ->where('room_id', $room_id)
            ->where('start_date', '<', $end_date->toDateTimeString())
            ->where('end_date', '>', $start_date->toDateTimeString())->get()->count();
    }

    public function getAvailabilities(Carbon $date, int $participants): array
    {
        $availableRooms = $this->getAvailableRooms($date, $participants);

        // Query available dates for each room
        $availabilities = [];
        foreach ($availableRooms as $room) {
            $availableDates = Booking::where('room_id', $room->id)
                ->where('start_date', '<', $date)
                ->where('end_date', '>', $date)
                ->pluck('start_date');

            $availabilities[] = [
                'room' => $room,
                'available_dates' => $availableDates,
            ];
        }

        return $availabilities;

    }

    /**
     * @return Collection<Room>
     */
    private function getAvailableRooms(Carbon $date, int $participants): Collection
    {
        return $this->room->newQuery()
            ->whereDoesntHave('bookings', function ($query) use ($date) {
                $query->where('start_date', '<', $date->toDateTimeString())
                    ->where('end_date', '>', $date->toDateTimeString());
            })->where('capacity', '>=', $participants)->get();
    }
}
