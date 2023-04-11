<?php

declare(strict_types=1);

namespace App\Source\Rating\App\Controllers;

use App\Source\Rating\App\Requests\SaveRatingRequest;
use App\Source\Rating\Domain\GetRatings\GetRatingsLogic;
use App\Source\Rating\Domain\SaveRating\SaveRatingLogic;
use Exception;
use Illuminate\Support\Facades\Auth;

class RatingController
{
    public function show(
        int $rideId,
        GetRatingsLogic $logic
    ) {
        $ratings = $logic->getRatings(userId: Auth::id(), rideId: $rideId);
        return view(
            'rating.show',
            compact('ratings')
        );
    }

    public function save(
        SaveRatingRequest $request,
        SaveRatingLogic $logic
    ) {
        try {
            $logic->save(
                graderId: Auth::id(),
                userToBeRatedId: (int)$request->user_to_be_rated_id,
                rideId: (int)$request->ride_id,
                comment: $request->comment,
                rating: (int)$request->stars
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
        }

        return redirect()->back();
    }
}
