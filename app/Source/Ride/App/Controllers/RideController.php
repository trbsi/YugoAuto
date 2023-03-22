<?php

declare(strict_types=1);

namespace App\Source\Ride\App\Controllers;

use App\Http\Controllers\Controller;
use App\Source\Place\Domain\SearchPlaces\SearchPlacesBusinessLogic;
use App\Source\Ride\App\Requests\SearchRidesRequest;
use App\Source\Ride\Domain\SearchRides\SearchRidesBusinessLogic;
use Illuminate\Support\Carbon;

class RideController extends Controller
{
    public function search(
        SearchRidesRequest $request,
        SearchRidesBusinessLogic $businessLogic,
        SearchPlacesBusinessLogic $placesBusinessLogic
    ) {
        $rides = null;
        $fromPlaceId = $fromPlaceName = $toPlaceId = $toPlaceName = $time = null;

        if ($request->from_place_id && $request->to_place_id && $request->time) {
            $rides = $businessLogic->search(
                (int)$request->from_place_id,
                (int)$request->to_place_id,
                Carbon::createFromFormat('Y-m-d\TH:i', $request->time)
            );

            $fromPlace = $placesBusinessLogic->getById((int)$request->from_place_id);
            $fromPlaceId = $fromPlace->getId();
            $fromPlaceName = $fromPlace->getName();
            $toPlace = $placesBusinessLogic->getById((int)$request->to_place_id);
            $toPlaceId = $toPlace->getId();
            $toPlaceName = $toPlace->getName();
            $time = $request->time;
        }

        return view(
            'ride.list',
            [
                'rides' => $rides,
                'fromPlaceId' => $fromPlaceId,
                'fromPlaceName' => $fromPlaceName,
                'toPlaceId' => $toPlaceId,
                'toPlaceName' => $toPlaceName,
                'time' => $time,
            ]
        );
    }
}
