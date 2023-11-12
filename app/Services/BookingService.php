<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Inertia\Inertia;

final class BookingService
{
    public function __construct(private readonly BookingRepository $bookingRepository)
    {
    }

    public function all()
    {
        $bookings = $this->bookingRepository->all();

        return Inertia::render();
    }
}
