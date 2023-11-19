<?php

namespace App\Http\Controllers;

use App\Http\Requests\Availabity\GetAvailabilityRequest;
use App\Services\AvailabilityService;
use Illuminate\Http\RedirectResponse;
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
        return $this->availabilityService->index();
    }

    public function search(GetAvailabilityRequest $request): RedirectResponse
    {
        return $this->availabilityService->searchAvailabilities($request->get('date_booking'), $request->get('participants'));
    }
}
