<?php

namespace App\Http\Middleware;

use App\Repositories\BookingRepository;
use App\Utils\Traits\Utils;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanCreateBooking
{
    use Utils;

    public function __construct(
        private readonly BookingRepository $bookingRepository,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isCreatable($request)) {
            return $next($request);
        }
        session()->flash('error', 'Not possible create a event, because there is already an event at that time, please change the event');

        return back()->withInput($request->all());
    }

    private function isCreatable(Request $request): bool
    {
        $startDate = $this->parseToDate($request->get('start_date'));
        $endDate = $this->parseToDate($request->get('end_date'));

        return ! $this->bookingRepository->checkBookings($request->get('room_id'), $startDate, $endDate);
    }
}
