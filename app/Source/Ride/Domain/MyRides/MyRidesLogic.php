<?php

declare(strict_types=1);

namespace App\Source\Ride\Domain\MyRides;

use App\Source\Ride\Infra\MyRides\Services\GetRidesByUserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MyRidesLogic
{
    private GetRidesByUserService $getRidesByUserService;

    public function __construct(
        GetRidesByUserService $getRidesByUserService
    ) {
        $this->getRidesByUserService = $getRidesByUserService;
    }

    public function get(int $userId): LengthAwarePaginator
    {
        return $this->getRidesByUserService->get($userId);
    }
}
