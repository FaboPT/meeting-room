<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Repositories\RoomRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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

    public function store(array $data): RedirectResponse
    {
        try {
            DB::transaction(function () use ($data) {
                $this->bookingRepository->store($data);
            });

            return redirect()->route('booking.index')->with('success', 'Booking successfully created');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function create(): Response
    {
        $rooms = $this->roomRepository->all();

        return Inertia::render('Bookings/Create', [
            'rooms' => $rooms,
        ]);
    }
}
