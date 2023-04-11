<?php

declare(strict_types=1);

namespace App\Source\Rating\App\Controllers;

use App\Models\User;
use App\Source\Rating\App\Requests\SaveRatingRequest;
use App\Source\Rating\Domain\GetRatings\GetRatingsLogic;
use App\Source\Rating\Domain\SaveRating\SaveRatingLogic;
use App\Source\Rating\Domain\UserRatings\GetUserRatingsLogic;
use Exception;
use Illuminate\Support\Facades\Auth;

class RatingController
{
    public function showRideRatings(
        int $rideId,
        GetRatingsLogic $logic
    ) {
        $ratings = $logic->getRatings(userId: Auth::id(), rideId: $rideId);
        return view(
            'rating.show-for-ride',
            compact('ratings')
        );
    }

    public function showUserRatings(
        int $userId,
        GetUserRatingsLogic $logic
    ) {
        $user = User::findOrFail($userId);
        $ratings = $logic->getRatings(userId: $userId);
        return view(
            'rating.show-for-user',
            compact('ratings', 'user')
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
