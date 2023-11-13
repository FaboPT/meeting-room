<?php

namespace App\Http\Middleware;

use App\Http\Requests\Booking\StoreBookingRequest;
use App\Repositories\BookingRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class CanCreateBooking
{
    public function __construct(private readonly BookingRepository $bookingRepository)
    {
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
        throw new ConflictHttpException('Not possible create a event, because there is already an event at that time, please change the event');
    }

    private function isCreatable(StoreBookingRequest $request): bool
    {
        return ! $this->bookingRepository->checkBookings($request->get('room_id'), $request->get('start_date'), $request->get('end_date'));
    }
}
