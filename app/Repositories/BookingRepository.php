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
        private readonly Room $room
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
        return $this->booking->with('room')->orderBy('room_id')->orderBy('start_date')->get();
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
            $bookedDates = $this->booking->newQuery()
                ->where('room_id', $room->id)
                ->whereDate('start_date', '<=', $date)
                ->whereDate('end_date', '>=', $date)
                ->pluck('end_date', 'start_date');

            $availableDates = $bookedDates->isEmpty() ? [$date->toDateTimeLocalString().' - '.'Free from 8 AM to 6 PM'] : $this->getAvailableDates($date, $bookedDates);

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

    private function getAvailableDates(Carbon $dateBooking, \Illuminate\Support\Collection $bookedDates): array
    {
        $dayStart = $dateBooking->copy()->setHour(8); // Set the start time, e.g., 8 AM
        $dayEnd = $dateBooking->copy()->setHour(18);   // Set the end time, e.g., 6 PM

        $availableDates = [];

        // Add the initial period if available
        if ($dayStart->lt($bookedDates->keys()->first())) {
            $availableDates[] = [
                'start' => $dayStart->format('Y-m-d H:i:s'),
                'end' => $bookedDates->keys()->first(),
            ];
        }

        // Iterate over the booked periods and update the available dates
        foreach ($bookedDates as $startDate => $endDate) {
            // Update the start time for the next iteration
            $dayStart = max($dayStart, $endDate);

            // Check if there is any time available between the bookings
            $nextStartDate = $bookedDates->keys()->first(function ($key) use ($dayStart) {
                return $key > $dayStart;
            });

            if ($nextStartDate && $dayStart->lt($nextStartDate)) {
                $availableDates[] = [
                    'start' => $dayStart->format('Y-m-d H:i:s'),
                    'end' => $nextStartDate,
                ];
            }
        }

        // Add the final period if available
        if ($dayEnd->gt($dayStart)) {
            $availableDates[] = [
                'start' => $dayStart->format('Y-m-d H:i:s'),
                'end' => $dayEnd->format('Y-m-d H:i:s'),
            ];
        }

        return $availableDates;
    }
}
