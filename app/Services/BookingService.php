<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;
use Inertia\Inertia;
use Inertia\Response;

final class BookingService
{
    public function __construct(
        private readonly BookingRepository $bookingRepository,
        private readonly RoomRepository $roomRepository,
    ) {
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
        $rooms = $this->roomRepository->all();

        return Inertia::render('Bookings/Create', [
            'rooms' => $rooms,
        ]);
    }
}
