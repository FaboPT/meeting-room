<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Inertia\Inertia;
use Inertia\Response;

final class BookingService
{
    public function __construct(private readonly BookingRepository $bookingRepository)
    {
    }

    public function all(): Response
    {
        $bookings = $this->bookingRepository->all();

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }

    public function store(array $data): Response
    {
        $bookings = $this->bookingRepository->store($data);

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Bookings/Create');
    }
}
