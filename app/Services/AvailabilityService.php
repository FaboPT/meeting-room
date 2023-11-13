<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use Inertia\Response;

final class AvailabilityService
{
    public function __construct(private readonly BookingRepository $bookingRepository)
    {
    }

    public function availabilities(Date $dateBooking, int $participants): Response
    {
        $availabilities = $this->bookingRepository->availabilities($dateBooking, $participants);

        return Inertia::render('Availabilities/Index', [
            'availabilities' => $availabilities,
        ]);
    }
}
