<?php

declare(strict_types=1);

namespace App\Source\Ride\App\Controllers;

use App\Http\Controllers\Controller;
use App\Source\Place\Domain\SearchPlaces\SearchPlacesBusinessLogic;
use App\Source\Ride\App\Requests\SearchRidesRequest;
use App\Source\Ride\Domain\SearchRides\SearchRidesBusinessLogic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    public function search(
        SearchRidesRequest $request,
        SearchRidesBusinessLogic $businessLogic,
        SearchPlacesBusinessLogic $placesBusinessLogic
    ) {
        $rides = null;
        $fromPlace = $toPlace = $time = null;

        if ($request->from_place_id && $request->to_place_id && $request->time) {
            $rides = $businessLogic->search(
                (int)$request->from_place_id,
                (int)$request->to_place_id,
                Carbon::createFromFormat('Y-m-d\TH:i', $request->time)
            );

            $fromPlace = $placesBusinessLogic->getById((int)$request->from_place_id);
            $toPlace = $placesBusinessLogic->getById((int)$request->to_place_id);
            $time = $request->time;
        }

        return view(
            (Auth::guest()) ? 'ride.public_list' : 'ride.list',
            [
                'rides' => $rides,
                'fromPlace' => $fromPlace,
                'toPlace' => $toPlace,
                'time' => $time,
            ]
        );
    }
}
