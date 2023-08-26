<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\Stats;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Support\Facades\Cache;

class RideStatsLogic
{
    private const CACHE_KEY = 'ride_cache_key';

    public function getStats(): array
    {
        if (Cache::has(self::CACHE_KEY)) {
            return Cache::get(self::CACHE_KEY);
        }

        $totalAccepted = RideRequest::where('status', RideRequestEnum::ACCEPTED->value)->count();
        $totalRideRequests = RideRequest::count();
        $lastRequestedRide = RideRequest::latest()->first();
        $totalRides = Ride::count();
        $firstRide = Ride::first();
        $lastPublishedRide = Ride::query()->latest()->first();

        $data = [
            'totalAccepted' => $totalAccepted,
            'totalAcceptedPercentage' => round(($totalAccepted / $totalRides) * 100, 0),
            'totalRideRequests' => $totalRideRequests,
            'totalRideRequestsPercentage' => round(($totalRideRequests / $totalRides) * 100, 0),
            'lastRideRequestDate' => $lastRequestedRide->created_at->format('d.m.Y.'),
            'totalRides' => $totalRides,
            'firstRideDate' => $firstRide->created_at->format('d.m.Y.'),
            'lastPublishedRideDate' => $lastPublishedRide->created_at->format('d.m.Y.'),
        ];
        Cache::put(self::CACHE_KEY, $data, now()->addHours(1));

        return $data;
    }
}
