<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Nette\NotImplementedException;
use Symfony\Component\HttpFoundation\Response;

class BookingRepository extends BaseRepository
{
    public function __construct(private readonly Booking $booking)
    {
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

    public function checkBookings(int $room_id, Date $start_date, Date $end_date): int
    {
        return $this->booking->newQuery()
            ->where('room_id', $room_id)
            ->where('start_date', '<', $end_date)
            ->where('end_date', '>', $start_date)->get()->count();
    }

    public function availabilities(Date $date, int $participants): Collection
    {
        return $this->booking->newQuery()
            ->whereHas('room', function ($query) use ($participants) {
                $query->where('capacity', '>=', $participants);
            })
            ->where('start_date', '<', $date)
            ->where('end_date', '>', $date)
            ->get();

    }
}
