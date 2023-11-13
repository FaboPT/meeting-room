<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreBookingRequest;
use App\Services\BookingService;
use Inertia\Response;

class BookingController extends Controller
{
    public function __construct(private readonly BookingService $bookingService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return $this->bookingService->all();
    }

    public function create(): Response
    {
        return $this->bookingService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request): Response
    {
        return $this->bookingService->store($request->validated());
    }
}
