<?php

declare(strict_types=1);

namespace App\Source\Place\App\Controllers;

use App\Source\Place\App\Requests\GetPlacesRequest;
use App\Source\Place\Domain\SearchPlaces\SearchPlacesLogic;
use Illuminate\Http\JsonResponse;

class PlaceController
{
    public function searchPlaces(
        GetPlacesRequest $request,
        SearchPlacesLogic $ogic
    ): JsonResponse {
        $places = $ogic->get($request->term);
        $data = [];
        foreach ($places as $place) {
            $data[] = [
                'value' => $place->getId(),
                'label' => $place->getName()
            ];
        }

        return response()->json($data);
        // return PlaceResource::collection($places);
    }
}
