<?php

namespace App\Http\Controllers;

use App\Http\Requests\Availabity\GetAvailabilityRequest;
use App\Services\AvailabilityService;
use Inertia\Response;

class AvailabilityController extends Controller
{
    public function __construct(private readonly AvailabilityService $availabilityService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(GetAvailabilityRequest $request): Response
    {
        return $this->availabilityService->availabilities($request->get('date'), $request->get('participants'));
    }
}
