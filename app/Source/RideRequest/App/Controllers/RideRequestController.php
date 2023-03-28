<?php

namespace App\Source\RideRequest\App\Controllers;

use App\Source\RideRequest\App\Requests\AcceptOrRejectRideRequest;
use App\Source\RideRequest\App\Requests\CancelRideRequest;
use App\Source\RideRequest\Domain\AcceptOrReject\AcceptOrRejectLogic;
use App\Source\RideRequest\Domain\CancelRide\CancelRideLogic;
use App\Source\RideRequest\Domain\RequestRide\RequestRideLogic;
use App\Source\RideRequest\Domain\RideRequests\RideRequestsLogic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RideRequestController
{
    public function myRequests(
        int $rideId,
        Request $request,
        RideRequestsLogic $logic
    ) {
        try {
            $requests = $logic->getRequests(Auth::id(), $rideId);
            $ride = $logic->getRide($rideId);
            return view(
                'ride-requests.my-requests.list',
                compact('requests', 'ride')
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function acceptOrReject(
        AcceptOrRejectRideRequest $request,
        AcceptOrRejectLogic $logic
    ) {
        try {
            $logic->acceptOrReject(
                driverId: Auth::id(),
                rideId: (int)$request->ride_id,
                passengerId: (int)$request->user_id,
                status: $request->status
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }

    public function sendRequest(
        int $rideId,
        Request $request,
        RequestRideLogic $logic
    ) {
        try {
            $logic->requestRide(Auth::id(), $rideId);
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }

    public function cancelRequest(
        CancelRideRequest $request,
        CancelRideLogic $logic
    ) {
        try {
            $logic->cancel(
                authUserId: Auth::id(),
                passengerId: $request->passenger_id,
                rideId: $request->ride_id
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }


}
