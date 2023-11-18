<?php

namespace App\Http\Controllers;

use App\Http\Requests\Availabity\GetAvailabilityRequest;
use App\Services\AvailabilityService;
use Inertia\Inertia;
use Inertia\Response;

class AvailabilityController extends Controller
{
    public function __construct(private readonly AvailabilityService $availabilityService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Availabilities/Index');
    }

    public function search(GetAvailabilityRequest $request): Response
    {
        return $this->availabilityService->searchAvailabilities($request->get('date_booking'), $request->get('participants'));
    }
}
