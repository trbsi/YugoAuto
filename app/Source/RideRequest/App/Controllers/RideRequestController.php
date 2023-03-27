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
        RideRequestsLogic $ogic
    ) {
        try {
            $requests = $ogic->getRequests(Auth::id(), $rideId);
            $ride = $ogic->getRide($rideId);
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
        AcceptOrRejectLogic $ogic
    ) {
        try {
            $ogic->acceptOrReject(
                Auth::id(),
                (int)$request->ride_id,
                (int)$request->user_id,
                $request->status
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
        RequestRideLogic $ogic
    ) {
        try {
            $ogic->requestRide(Auth::id(), $rideId);
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }

    public function cancelRequest(
        CancelRideRequest $request,
        CancelRideLogic $ogic
    ) {
        try {
            $ogic->cancel(
                Auth::id(),
                $request->passenger_id,
                $request->ride_id
            );
        } catch (Exception $exception) {
            $request->session()->flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
        }

        return redirect()->back();
    }


}
