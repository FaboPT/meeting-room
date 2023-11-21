<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use App\Utils\Traits\Utils;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class AvailabilityService
{
    use Utils;

    public function __construct(private readonly BookingRepository $bookingRepository)
    {
    }

    public function index(): Response
    {
        $availabilities = session('availabilities', []);

        if (session()->has('availabilities')) {
            Inertia::share('availabilities', $availabilities);
        }

        return Inertia::render('Availabilities/Index', [
            'availabilities' => $availabilities,
        ]);
    }

    public function searchAvailabilities(string $dateBooking, int $participants): RedirectResponse
    {
        $dateBooking = $this->parseToDate($dateBooking);
        $availabilities = $this->bookingRepository->getAvailabilities($dateBooking, $participants);

        session()->put('availabilities', $availabilities);
        session()->save();

        return redirect(route('availability.index'))->with('availabilities', $availabilities);
    }
}
