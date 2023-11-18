<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Utils\Traits\Utils;
use Inertia\Inertia;
use Inertia\Response;

final class AvailabilityService
{
    use Utils;

    public function __construct(private readonly BookingRepository $bookingRepository)
    {
    }

    public function searchAvailabilities(string $dateBooking, int $participants): Response
    {
        $dateBooking = $this->parseToDate($dateBooking);
        $availabilities = $this->bookingRepository->getAvailabilities($dateBooking, $participants);

        return Inertia::render('Availabilities/Index', [
            'availabilities' => $availabilities,
        ]);
    }
}
